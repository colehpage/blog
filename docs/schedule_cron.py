from crontab import CronTab

my_cron = CronTab(user='colehpage')

my_cron.remove_all()

job = my_cron.new(command='cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
job.minute.every(1)

job = my_cron.new(command='sleep 10 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
job.minute.every(1)

job = my_cron.new(command='sleep 20 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
job.minute.every(1)

job = my_cron.new(command='sleep 30 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
job.minute.every(1)

job = my_cron.new(command='sleep 40 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
job.minute.every(1)

job = my_cron.new(command='sleep 50 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
job.minute.every(1)

# job = my_cron.new(command='sleep 12 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 14 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 16 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 18 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 20 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 22 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 24 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 26 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 28 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 30 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 32 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 34 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 36 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 38 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 40 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 42 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 44 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 46 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 48 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 50 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 52 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 54 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 56 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

# job = my_cron.new(command='sleep 58 && cd /home/colehpage/lines_scraper/ && /home/colehpage/anaconda3/bin/python /home/colehpage/lines_scraper/nba_lines_scraper.py >/dev/null 2>&1')
# job.minute.every(1)

my_cron.write()
