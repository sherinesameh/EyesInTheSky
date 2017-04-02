import pymysql

conn = pymysql.connect(host='localhost',user='root',password='eits2017',db='EITS')

a = conn.cursor()

query = 'SELECT * from Admin WHERE 1'

a.execute(query)

countrow = a.execute(query)

print("Number of rows : ",countrow)

data = a.fetchone()

print(data)