import requests
from bs4 import BeautifulSoup
import datetime
from datetime import date
import time
import pandas as pd
from pandas import DataFrame
import os
import psycopg2
from pprint import pprint
from sqlalchemy import create_engine
from crontab import CronTab

def parse_and_write_data(soup, date, time):
## Parse HTML to gather line data by book
    def book_line(book_id, line_id, homeaway):
        ## Get Line info from book ID
        line = soup.find_all('div', attrs = {'class':'el-div eventLine-book', 'rel':book_id})[line_id].find_all('div')[homeaway].get_text().strip()
        return line

    '''
    BookID  BookName
    238     Pinnacle
    93      BookMaker
    '''

    df = DataFrame(
            columns=('key','game_id','game_date','scrape_time','team','opp_team','line','odds'))

    counter = 0
    number_of_games = len(soup.find_all('div', attrs = {'class':'el-div eventLine-rotation'}))
    for i in range(0, number_of_games):
        A = []
        H = []
        # print(str(i+1)+'/'+str(number_of_games))
        ## Gather all useful data from unique books
        info_A = soup.find_all('div', attrs = {'class':'el-div eventLine-team'})[i].find_all('div')[0].get_text().strip()
        team_A = info_A
        try:
            away =      book_line('93', i, 0)
        except IndexError:
            away = ''
        info_H = soup.find_all('div', attrs = {'class':'el-div eventLine-team'})[i].find_all('div')[1].get_text().strip()
        team_H = info_H
        try:
            home =      book_line('93', i, 1)
        except IndexError:
            home = ''
        if team_H ==   'Detroit':
            team_H =   'Detroit'
        elif team_H == 'Indiana':
            team_H =   'Indiana'
        elif team_H == 'Brooklyn':
            team_H =   'Brooklyn'
        elif team_H == 'L.A. Lakers':
            team_H =   'L.A. Lakers'
        elif team_H == 'Washington':
            team_H =   'Washington'
        elif team_H == 'Miami':
            team_H =   'Miami'
        elif team_H == 'Minnesota':
            team_H =   'Minnesota'
        elif team_H == 'Chicago':
            team_H =   'Chicago'
        elif team_H == 'Oklahoma City':
            team_H =   'Oklahoma City'
        if team_A ==   'New Orleans':
            team_A =   'New Orleans'
        elif team_A == 'Houston':
            team_A =   'Houston'
        elif team_A == 'Dallas':
            team_A =   'Dallas'
        elif team_A == 'Cleveland':
            team_A =   'Cleveland'
        elif team_A == 'L.A. Clippers':
            team_A =   'L.A. Clippers'
        elif team_A == 'Golden State':
            team_A =   'Golden State'
        elif team_A == 'Denver':
            team_A =   'Denver'
        elif team_A == 'Boston':
            team_A =   'Boston'
        elif team_A == 'Milwaukee':
            team_A =   'Milwaukee'             


        timeid = str(time)
        timeid = timeid.replace(":", "")

        A.append(date+""+str(i)+"A"+timeid)
        A.append(date+str(i))
        A.append(date)
        A.append(time)
        A.append(team_A)
        A.append(team_H)

        away = away.replace(u'\xa0',' ').replace(u'\xbd','.5')
        away_line = away[:away.find(' ')]
        away_odds = away[away.find(' ') + 1:]
        A.append(away_line)
        A.append(away_odds)


        H.append(date+""+str(i)+"H"+timeid)
        H.append(date+str(i))
        H.append(date)
        H.append(time)
        H.append(team_H)
        H.append(team_A)
        
        home = home.replace(u'\xa0',' ').replace(u'\xbd','.5')
        home_line = home[:home.find(' ')]
        home_odds = home[home.find(' ') + 1:]
        H.append(home_line)
        H.append(home_odds)

        ## Take data from A and H (lists) and put them into DataFrame
        df.loc[counter]   = ([A[j] for j in range(len(A))])
        df.loc[counter+1] = ([H[j] for j in range(len(H))])
        counter += 2
    return df


def soup_url(type_of_line, tdate = str(date.today()).replace('-','')):
## get html code for odds based on desired line type and date
    if type_of_line == 'Spreads':
        url_addon = ''
    elif type_of_line == 'Totals':
        url_addon = 'totals/'
    elif type_of_line == '1HSpread':
        url_addon = '1st-half/'
    elif type_of_line == '1HTotal':
        url_addon = 'totals/1st-half/'
    else:
        print("Wrong url_addon")
    url = 'http://www.sportsbookreview.com/betting-odds/nba-basketball/' + url_addon + '?date=' + tdate
    now = datetime.datetime.now()
    raw_data = requests.get(url)
    soup_big = BeautifulSoup(raw_data.text, 'html.parser')
    soup = soup_big.find_all('div', id='OddsGridModule_5')[0]
    timestamp = time.strftime("%H:%M:%S")
    return soup, timestamp


def select_and_rename(df, text):
    ## Select only useful column names from a DataFrame
    ## Rename column names so that when merged, each df will be unique 
    df = df[['key','game_id','game_date','scrape_time','team','opp_team','line','odds']]

    df.columns = ['key','game_id','game_date','scrape_time','team','opp_team',text+'_line',text+'_odds']
    return df

def run_command(command):
    cur.execute(command)
    return cur.statusmessage

def run_query(query):
    return pd.read_sql_query(query,con=engine)

def main():
    ## Get today's lines
    todays_date = str(date.today()).replace('-','')
    ## change todays_date to be whatever date you want to pull in the format 'yyyymmdd'
    ## One could force user input and if results in blank, revert to today's date. 
    # todays_date = '20140611'

    ## store BeautifulSoup info for parsing
    soup_rl, time_rl = soup_url('Spreads', todays_date)
    print("Scraping Spreads (1/4)")
    soup_tot, time_tot = soup_url('Totals', todays_date)
    print("Scraping Totals (2/4)")
    soup_1h_rl, time_1h_rl = soup_url('1HSpread', todays_date)
    print("Scraping 1H Spreads (3/4)")
    soup_1h_tot, time_1h_tot = soup_url('1HTotal', todays_date)
    print("Scraping 1H Totals (4/4)")

    t = datetime.datetime.now()

    #### Each df_xx creates a data frame for a bet type
    print("Logging Spreads (1/4)")
    df_rl = parse_and_write_data(soup_rl, todays_date, t)
    df_rl = select_and_rename(df_rl, 'spread')

    print("Logging Totals (2/4)")
    df_tot = parse_and_write_data(soup_tot, todays_date, t)
    df_tot = select_and_rename(df_tot, 'total')

    print("Logging 1H Spreads (3/4)")
    df_1h_rl = parse_and_write_data(soup_1h_rl, todays_date, t)
    df_1h_rl = select_and_rename(df_1h_rl, 'fh_spread')

    print("Logging 1H Totals (4/4)")
    df_1h_tot = parse_and_write_data(soup_1h_tot, todays_date, t)
    df_1h_tot = select_and_rename(df_1h_tot, 'fh_total')

    ## Merge all DataFrames together to allow for simple printout
    write_df = df_rl
    write_df = write_df.merge(df_tot, how='left', on = ['key','game_id','game_date','scrape_time','team','opp_team'])
    write_df = write_df.merge(df_1h_rl, how='left', on = ['key','game_id','game_date','scrape_time','team','opp_team'])
    write_df = write_df.merge(df_1h_tot, how='left', on = ['key','game_id','game_date','scrape_time','team','opp_team'])

    engine = create_engine('postgresql://colehpage:colehpage@localhost:5432/nba_lines')

    write_df.to_sql("games_"+str(date.today()).replace('-',''), engine, if_exists='append', index=False)


if __name__ == '__main__':
    main()
