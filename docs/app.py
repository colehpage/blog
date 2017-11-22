#!/bin/bash

# -*- coding: utf-8 -*-
import dash
import dash_core_components as dcc
import dash_html_components as html
from dash.dependencies import Input, Output, State, Event

import pickle
import copy
import pandas as pd
import numpy as np

import requests
import datetime
from datetime import date
import time
import plotly.plotly as py
from plotly.graph_objs import *
from scipy.stats import rayleigh

import os
import psycopg2 as p
from pprint import pprint
from sqlalchemy import create_engine
from flask import Flask
import sqlite3

import plotly.graph_objs as go

import pytz
from pytz import timezone


# Setup app
app = dash.Dash(__name__)
server = app.server

def generate_table(dataframe, max_rows=24):
    return html.Table(
        # Header
        [html.Tr([html.Th(col) for col in dataframe.columns])] +

        # Body
        [html.Tr([
            html.Td(dataframe.iloc[i][col]) for col in dataframe.columns
        ]) for i in range(len(dataframe)-max_rows, len(dataframe))]
    )

def run_query(query):
    return pd.read_sql_query(query,con=engine)


todays_date = str(date.today()).replace('-','')
todays_table = str('games_'+todays_date)

con = p.connect("dbname='nba_lines' user='colehpage' host='colehpage.ddns.net' password='colehpage'")
cur = con.cursor()
engine = create_engine('postgresql://colehpage:colehpage@colehpage.ddns.net:5432/nba_lines')

query = 'SELECT * FROM "{}"'.format(todays_table)
cur.execute(query)
todays_df = run_query(query)

refresh_interval = 10000

colors = {
    'background': '#fff',
    'titles': 'rgba(0,0,0,1)',
    'text': 'rgba(0,0,0,1)',
    'chart-lines': 'rgba(0,0,0,.2)'
}

team_colors = {
    'Atlanta':('#C4D600','#C8102E','#25282A','#FFFFFF','#','#'),
    'Boston':('#007A33','#000000','#FFD700','#C0C0C0','#FFFFFF','#'),
    'Brooklyn':('#010101','#565656','#FFFFFF','#','#','#'),
    'Charlotte':('#201747','#00778B','#888B8D','#FFFFFF','#','#'),
    'Chicago':('#BA0C2F','#000000','#FFFFFF','#','#','#'),
    'Cleveland':('#6F263D','#FFB81C','#041E42','#FFFFFF','#','#'),
    'Dallas':('#0050B5','#8D9093','#0C2340','#000000','#FFFFFF','#'),
    'Denver':('#418FDE','#FFC72C','#041E42','#FFFFFF','#','#'),
    'Detroit':('#003DA5','#D50032','#041E42','#FFFFFF','#','#'),
    'Golden State':('#003DA5','#FFC72D','#FFFFFF','#','#','#'),
    'Houston':('#BA0C2F','#8D9093','#FDB927','#000000','#FFFFFF','#'),
    'Indiana':('#041E42','#FFB81C','#B1B3B3','#FFFFFF','#','#'),
    'L.A. Clippers':('#D50032','#003DA5','#B1B3B3','#FFFFFF','#','#'),
    'L.A. Lakers':('#702F8A','#FFC72C','#FFFFFF','#','#','#'),
    'Memphis':('#23375B','#6189B9','#BBD1E4','#FFD432','#FFFFFF','#'),
    'Miami':('#862633','#FFA300','#000000','#FFFFFF','#','#'),
    'Milwaukee':('#2C5234','#DDCBA4','#0057B8','#000000','#FFFFFF','#'),
    'Minnesota':('#002B5C','#7AC143','#C6CFD4','#005083','#FFFFFF','#'),
    'New Orleans':('#002B5C','#B4975A','#E31937','#FFFFFF','#','#'),
    'New York':('#003DA5','#FF671F','#B1B3B3','#FFFFFF','#','#'),
    'Oklahoma City':('#007DC3','#F05133','#FDBB30','#002D62','#FFFFFF','#'),
    'Orlando':('#007DC5','#C4CED3','#000000','#FFFFFF','#','#'),
    'Philadelphia':('#006BB6','#ED174C','#FFFFFF','#','#','#'),
    'Phoenix':('#E56020','#1D1160','#63717A','#000000','#FFFFFF','#'),
    'Portland':('#F0163A','#B6BFBF','#000000','#FFFFFF','#','#'),
    'Sacramento':('#724C9F','#8E9090','#000000','#FFFFFF','#','#'),
    'San Antonio':('#B6BFBF','#000000','#FFFFFF','#','#','#'),
    'Toronto':('#CE1141','#C4CED3','#000000','#FFFFFF','#','#'),
    'Utah':('#F9A01B','#00471B','#002B5C','#BEC0C2','#FFFFFF','#'),
    'Washington':('#0C2340','#C8102E','#8D9093','#FFFFFF','#','#'),
}

tc_df = pd.DataFrame(team_colors)

app.layout = html.Div(style={'backgroundColor': colors['background']}, children=[
    html.Div(id='main',style={}, children=[
        html.Div(id='wrapper',style={}, children=[    
            html.Div(id='header-wrapper',children=[
                html.Div(id='section-header', style={'padding':'10px'}, children='Line Movement Dashboard'),
                # html.Div(
                #     children='Lines Movements Dashboard',
                #     style={
                #         'textAlign': 'center',
                #         'color': '#333',
                #         'font-size': '30px',
                #         'padding-top':'20px',
                #     }
                # ),

                # html.Div(children='A live dashboard for daily real-time line movements in the NBA.', style={
                #     'textAlign': 'center',
                #     'color': '#333'
                # }),

                # html.Div(children='(UNFINISHED BUT LIVE)', style={
                #     'textAlign': 'center',
                #     'color': '#333',
                #     'padding-bottom':'20px'
                # }),
            ]),

            html.Div(style={'margin-bottom':'50px',
                            'margin-top':'100px',
                            'padding-left':'50px',
                            'padding-right':'50px'},children=[
                html.Div([
                    dcc.Dropdown(
                        id='team-dropdown',
                        options=[{'label':i,'value':i} for i in todays_df['team'].unique()],
                        value=[str(team) for team in todays_df['team'].unique()][0],
                        # multi=True
                    )
                ], style={'margin-bottom':'20px'}),

                html.Div(style={'border':'1px solid #333'},children=[
                    html.Div(id='section-header', children='Past Hour Momentum:'),
                    html.Div(style={'padding':'0px'},children=[
                        html.Div([
                            html.Div(children='Spread',style={'border-bottom':'1px solid #333','border-right':'1px solid #333','padding':'5px'}),
                            html.Div(id='spread-momentum',style={'border-right':'1px solid #333'}),
                            dcc.Interval(id='momentum-update', interval=refresh_interval),
                        ], style={'display': 'inline-block', 'width': '50%'}),
                        html.Div([
                            html.Div(children='Total',style={'border-bottom':'1px solid #333','padding':'5px'}),
                            html.Div(id='total-momentum'),
                            dcc.Interval(id='momentum-update', interval=refresh_interval),
                        ], style={'display': 'inline-block', 'width': '50%', 'float':'right'}),
                    ])    
                ]),

                html.Div(style={'border':'1px solid #333'},children=[
                    html.Div(id='section-header', children='Total and Spread Movements:'),
                    html.Div(style={'padding':'20px','padding-bottom':'0px'},children=[
                        html.Div([
                            html.Div(children='Full Game',style={'text-align':'center'}),
                            dcc.Graph(id='line-movements'),
                            dcc.Interval(id='lines-update', interval=refresh_interval),
                        ], style={'display': 'inline-block', 'width': '49%'}),
                        html.Div([
                            html.Div(children='First Half',style={'text-align':'center'}),
                            dcc.Graph(id='fh-line-movements'),
                            dcc.Interval(id='lines-update', interval=refresh_interval),
                        ], style={'display': 'inline-block', 'width': '49%', 'float':'right'}),
                    ])    
                ]),

                 html.Div(style={'border':'1px solid #333'},children=[
                    html.Div(id='section-header', children='Season '),
                ]),
            ])
        ])
    ])
])

@app.callback(
    Output('spread-momentum', 'children'),
    [Input('team-dropdown', 'value')],
    [],
    [Event('momentum-update', 'interval')])

def update_spread_momentum(selected_team):
    todays_date = str(date.today()).replace('-','')
    todays_table = str('games_'+todays_date)

    con = p.connect("dbname='nba_lines' user='colehpage' host='colehpage.ddns.net' password='colehpage'")
    cur = con.cursor()
    engine = create_engine('postgresql://colehpage:colehpage@colehpage.ddns.net:5432/nba_lines')

    query = 'SELECT * FROM "{}"'.format(todays_table)
    cur.execute(query)
    todays_df = run_query(query)

    filtered_df = todays_df.loc[todays_df.team == selected_team].copy()
    filtered_df.replace(r'^\s*$', np.nan, regex=True, inplace=True)
    filtered_df.replace(r'PK-11', '0', regex=True, inplace=True)
    filtered_df.replace(r'PK-10', '0', regex=True, inplace=True)
    filtered_df.ffill(inplace=True)

    if float(filtered_df.iloc[-360].spread_line) < 0:
        if float(filtered_df.iloc[-360].spread_line) < float(filtered_df.iloc[-1].spread_line):
            mom_val = 'SMALLER'
            mom_color = 'rgba(255,0,0,.3)'
        elif float(filtered_df.iloc[-360].spread_line) > float(filtered_df.iloc[-1].spread_line):
            mom_val = 'LARGER'
            mom_color = 'rgba(0,255,0,.3)'
        else:
            mom_val = 'NO CHANGE'
            mom_color = 'rgba(255,255,0,.3)'
    else:
        if float(filtered_df.iloc[-360].spread_line) > float(filtered_df.iloc[-1].spread_line):
            mom_val = 'SMALLER'
            mom_color = 'rgba(255,0,0,.3)'
        elif float(filtered_df.iloc[-360].spread_line) < float(filtered_df.iloc[-1].spread_line):
            mom_val = 'LARGER'
            mom_color = 'rgba(0,255,0,.3)'
        else:
            mom_val = 'NO CHANGE'
            mom_color = 'rgba(255,255,0,.3)'
        
    return html.Div(id='mom-text', children= mom_val, style={'background': mom_color})

@app.callback(
    Output('total-momentum', 'children'),
    [Input('team-dropdown', 'value')],
    [],
    [Event('momentum-update', 'interval')])

def update_total_momentum(selected_team):
    todays_date = str(date.today()).replace('-','')
    todays_table = str('games_'+todays_date)

    con = p.connect("dbname='nba_lines' user='colehpage' host='colehpage.ddns.net' password='colehpage'")
    cur = con.cursor()
    engine = create_engine('postgresql://colehpage:colehpage@colehpage.ddns.net:5432/nba_lines')

    query = 'SELECT * FROM "{}"'.format(todays_table)
    cur.execute(query)
    todays_df = run_query(query)

    filtered_df = todays_df.loc[todays_df.team == selected_team].copy()
    filtered_df.replace(r'^\s*$', np.nan, regex=True, inplace=True)
    filtered_df.replace(r'PK-11', '0', regex=True, inplace=True)
    filtered_df.replace(r'PK-10', '0', regex=True, inplace=True)
    filtered_df.ffill(inplace=True)
    filtered_df.bfill(inplace=True)


    if float(filtered_df.iloc[-360].total_line) < 0:
        if float(filtered_df.iloc[-360].total_line) < float(filtered_df.iloc[-1].total_line):
            mom_val = 'DOWN'
            mom_color = 'rgba(255,0,0,.3)'
        elif float(filtered_df.iloc[-360].total_line) > float(filtered_df.iloc[-1].total_line):
            mom_val = 'UP'
            mom_color = 'rgba(0,255,0,.3)'
        else:
            mom_val = 'NO CHANGE'
            mom_color = 'rgba(255,255,0,.3)'
    else:
        if float(filtered_df.iloc[-360].total_line) > float(filtered_df.iloc[-1].total_line):
            mom_val = 'DOWN'
            mom_color = 'rgba(255,0,0,.3)'
        elif float(filtered_df.iloc[-360].total_line) < float(filtered_df.iloc[-1].total_line):
            mom_val = 'UP'
            mom_color = 'rgba(0,255,0,.3)'
        else:
            mom_val = 'NO CHANGE'
            mom_color = 'rgba(255,255,0,.3)'

    return html.Div(id='mom-text', children= mom_val, style={'background': mom_color})


@app.callback(
    Output('line-movements', 'figure'),
    [Input('team-dropdown', 'value')],
    [],
    [Event('lines-update', 'interval')])

def update_lines(selected_team):

    todays_date = str(date.today()).replace('-','')
    todays_table = str('games_'+todays_date)

    con = p.connect("dbname='nba_lines' user='colehpage' host='colehpage.ddns.net' password='colehpage'")
    cur = con.cursor()
    engine = create_engine('postgresql://colehpage:colehpage@colehpage.ddns.net:5432/nba_lines')

    query = 'SELECT * FROM "{}"'.format(todays_table)
    cur.execute(query)
    todays_df = run_query(query)

    filtered_df = todays_df.loc[todays_df.team == selected_team].copy()
    filtered_df.replace(r'^\s*$', np.nan, regex=True, inplace=True)
    filtered_df.replace(r'PK-11', '0', regex=True, inplace=True)
    filtered_df.replace(r'PK-10', '0', regex=True, inplace=True)
    filtered_df.fillna(method='bfill',inplace=True)
    
    trace1 = go.Scatter(
        x=filtered_df['scrape_time'],
        y=filtered_df['spread_line'],
        mode='lines',
        line={'width':2,'color':team_colors[selected_team][0]},
        name='Spread',
        # marker=dict(symbol='circle',line={'width':5}),
        text=None,
    )

    trace2 = go.Scatter(
        x=filtered_df['scrape_time'],
        y=filtered_df['total_line'],
        mode='lines',
        name='Total',
        line={'width':2,'color':team_colors[selected_team][1]},
        yaxis='y2',
        # marker=dict(symbol='circle',line={'width':5}),
        text=None
    )


    layout = Layout(
        legend={'x':0.01,'y':1,'orientation':'h'},
        height=600,
        # font=dict(color='#ffffff'),
        # title='Full Game',
        titlefont={'color':colors['text']},
        xaxis=dict(
            nticks=max(0,20),
            # title='Scrape Time',
            tickfont= {'color':colors['text']},
            ticklen=10,
            showgrid=False,
            showline=True,
            tickcolor='rgba(0,0,0,1)',
            gridcolor = colors['chart-lines'],
            rangeselector=dict(
                bgcolor='lightgrey',
                buttons=list([
                    dict(count=12,
                         label='12hr',
                         step='hour',
                         stepmode='backward'),
                    dict(count=6,
                         label='6hr',
                         step='hour',
                         stepmode='backward'),
                    dict(count=1,
                        label='1hr',
                        step='hour',
                        stepmode='backward'),
                    dict(count=30,
                        label='30min',
                        step='minute',
                        stepmode='backward'),
                    dict(count=10,
                        label='10min',
                        step='minute',
                        stepmode='backward'),
                    dict(count=1,
                        label='1min',
                        step='minute',
                        stepmode='backward'),

                ])
            ),
            rangeslider=dict(),
            type='date'
        ),

        yaxis=dict(
            # title= 'Spread',
            range=[float(min(filtered_df['spread_line']))-3.0,float(max(filtered_df['spread_line']))+3.0],
            tickfont={'color': team_colors[selected_team][0]},
            titlefont={'color': colors['text']},
            gridcolor = colors['chart-lines'],
            nticks=((float(max(filtered_df['spread_line']))+3.0)-(float(min(filtered_df['spread_line']))-3.0))*4,
            showgrid=True,
            showline=True,
            ticklen=5,
            zeroline=False
        ),
        yaxis2=dict(
            # title= 'Total',
            range=[float(min(filtered_df['total_line']))-2.0,float(max(filtered_df['total_line']))+2.0],
            tickfont={'color': team_colors[selected_team][1]},
            titlefont={'color':colors['text']},
            gridcolor = colors['chart-lines'],
            side='right',
            overlaying='y',
            nticks=((float(max(filtered_df['total_line']))+2.0)-(float(min(filtered_df['total_line']))-2.0))*4,
            showgrid=False,
            showline=True,
            ticklen=5,
            zeroline=False
        ),
        margin=Margin(
            t=50,
            l=50,
            r=50,
            b=100
        ),
        
    )

    fig = dict(data=[trace1,trace2],layout=layout)

    timenow = datetime.datetime.now(pytz.timezone('EST'))
    time30minago = timenow - datetime.timedelta(minutes=60)

    initial_range = [format(time30minago,'%Y-%m-%d %H:%M:%S'),format(timenow,'%Y-%m-%d %H:%M:%S')]
    fig['layout']['xaxis'].update(range=initial_range)

    return fig

@app.callback(
    Output('fh-line-movements', 'figure'),
    [Input('team-dropdown', 'value')],
    [],
    [Event('lines-update', 'interval')])

def update_1h_lines(selected_team):
    todays_date = str(date.today()).replace('-','')
    todays_table = str('games_'+todays_date)

    con = p.connect("dbname='nba_lines' user='colehpage' host='colehpage.ddns.net' password='colehpage'")
    cur = con.cursor()
    engine = create_engine('postgresql://colehpage:colehpage@colehpage.ddns.net:5432/nba_lines')

    query = 'SELECT * FROM "{}"'.format(todays_table)
    cur.execute(query)
    todays_df = run_query(query)

    filtered_df = todays_df.loc[todays_df.team == selected_team].copy()
    filtered_df.replace(r'^\s*$', np.nan, regex=True, inplace=True)
    filtered_df.replace(r'PK-11', '0', regex=True, inplace=True)
    filtered_df.replace(r'PK-10', '0', regex=True, inplace=True)
    filtered_df.ffill(inplace=True)
    filtered_df.fillna(method='bfill',inplace=True)

    
    trace1 = go.Scatter(
        x=filtered_df['scrape_time'],
        y=filtered_df['fh_spread_line'],
        mode='lines',
        line={'width':2,'color':team_colors[selected_team][0]},
        name='Spread',
        marker=dict(symbol='circle',line={'width':2})
    )

    trace2 = go.Scatter(
        x=filtered_df['scrape_time'],
        y=filtered_df['fh_total_line'],
        mode='lines',
        line={'width':2,'color':team_colors[selected_team][1]},
        name='Total',
        yaxis='y2',
        marker=dict(symbol='circle',line={'width':2})  
    )

    layout = Layout(
        legend={'x':0.01,'y':1,'orientation':'h'},
        height=600,
        # font=dict(color='#ffffff'),
        # title='First Half',
        titlefont={'color':colors['text']},
        xaxis=dict(
            nticks=max(0,20),
            # title='Scrape Time',
            tickfont= {'color':colors['text']},
            ticklen=10,
            showgrid=False,
            showline=True,
            tickcolor='rgba(0,0,0,1)',
            gridcolor = colors['chart-lines'],
            rangeselector=dict(
                bgcolor='lightgrey',
                buttons=list([
                    dict(count=12,
                         label='12hr',
                         step='hour',
                         stepmode='backward'),
                    dict(count=6,
                         label='6hr',
                         step='hour',
                         stepmode='backward'),
                    dict(count=1,
                        label='1hr',
                        step='hour',
                        stepmode='backward'),
                    dict(count=30,
                        label='30min',
                        step='minute',
                        stepmode='backward'),
                    dict(count=10,
                        label='10min',
                        step='minute',
                        stepmode='backward'),
                    dict(count=1,
                        label='1min',
                        step='minute',
                        stepmode='backward'),

                ])
            ),
            rangeslider=dict(),
            type='date'
        ),

        yaxis=dict(
            # title= 'Spread',
            range=[float(min(filtered_df['fh_spread_line']))-3.0,float(max(filtered_df['fh_spread_line']))+3.0],
            tickfont={'color': team_colors[selected_team][0]},
            titlefont={'color': colors['text']},
            gridcolor = colors['chart-lines'],
            nticks=((float(max(filtered_df['fh_spread_line']))+3.0)-(float(min(filtered_df['fh_spread_line']))-3.0))*4,
            showgrid=True,
            showline=True,
            ticklen=5,
            zeroline=False
        ),
        yaxis2=dict(
            # title= 'Total',
            range=[float(min(filtered_df['fh_total_line']))-2.0,float(max(filtered_df['fh_total_line']))+2.0],
            tickfont={'color': team_colors[selected_team][1]},
            titlefont={'color':colors['text']},
            gridcolor = colors['chart-lines'],
            side='right',
            overlaying='y',
            nticks=((float(max(filtered_df['fh_total_line']))+2.0)-(float(min(filtered_df['fh_total_line']))-2.0))*4,
            showgrid=False,
            showline=True,
            ticklen=5,
            zeroline=False
        ),
        margin=Margin(
            t=50,
            l=50,
            r=50,
            b=100
        ),
        
    )

    fig = dict(data=[trace1,trace2],layout=layout)

    timenow = datetime.datetime.now(pytz.timezone('EST'))
    time30minago = timenow - datetime.timedelta(minutes=60)

    initial_range = [format(time30minago,'%Y-%m-%d %H:%M:%S'),format(timenow,'%Y-%m-%d %H:%M:%S')]
    fig['layout']['xaxis'].update(range=initial_range)

    return fig

app.css.append_css({"external_url": "https://codepen.io/colehpage/pen/rYWdvY.css"})

if __name__ == '__main__':
    app.run_server()