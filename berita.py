from selenium import webdriver
from bs4 import BeautifulSoup
import pandas as pd
driver = webdriver.Chrome("F:\S6\chromedriver.exe")
berita=[] #crawling data
# url web
driver.get("https://www.viva.co.id/tag/tvone")
content = driver.page_source
soup = BeautifulSoup(content)
for crawling in soup.findAll('span'):
	name=crawling.find('a', attrs={'class':'title-content'})
	berita.append(name.text)

	df = pd.DataFrame({'Link Berita':berita}) 
	df.to_csv('co.csv', index=False, encoding='utf-8')