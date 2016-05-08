#!/usr/bin/python
#import matplotlib.pyplot as plt
#from matplotlib.ticker import FuncFormatter, MaxNLocator
import MySQLdb
import sys
import time
import datetime

db = MySQLdb.connect("127.0.0.1","root","","alipay" )
db.set_character_set('utf8')
cursor = db.cursor()
'''
sql = """CREATE TABLE alipay (
         createtime CHAR (50),
         pay_date INT(8),
         pay_time CHAR(20),
         pay_id CHAR(50),
         buyer VERCHAR(60),
         total FLOAT)"""
cursor.execute(sql)
db.commit()
'''
date_ana = {}
buyer_ana = {}

fileo = open('temp0.txt','r')
for line in fileo:
    arr = line.rstrip('\n').split(',')
    sql = "SELECT * FROM alipay WHERE pay_id = '%s'" % (arr[0])
    cursor.execute(sql)
    results = cursor.fetchall()
    if results:
        print results
        break
    else:
        try:
            sql = """INSERT INTO alipay (pay_id,createtime,buyer,total,pay_date,pay_time) 
                VALUES ('%s','%s','%s',%s,%s,'%s')""" % (arr[0],arr[1],arr[2],arr[3],arr[4],arr[5])

            #print 'Start>>>\n'+sql
            cursor.execute(sql)
            db.commit()
            if date_ana.get(arr[4]) == None:
                date_ana[arr[4]] = 0.0
            date_ana[arr[4]] += float(arr[3])
            if buyer_ana.get(arr[2]) == None:
                buyer_ana[arr[2]] = 0.0
            buyer_ana[arr[2]] += float(arr[3])
        except:
            print 'error\n'

for key,value in sorted(date_ana.items()):
    sql = "SELECT * FROM alipay_by_date WHERE pay_by_date = '%s'" % (key)
    cursor.execute(sql)
    results = cursor.fetchall()
    if results:
        print results
    else:
        sql = """INSERT INTO alipay_by_date (pay_by_date,total) 
              VALUES (%s,%s)""" % (key,value)
        
        #print 'Start>>>\n'+sql
        cursor.execute(sql)
        db.commit()

for key,value in buyer_ana.items():
    sql = "SELECT * FROM alipay_by_buyer WHERE pay_by_buyer = '%s'" % (key)
    cursor.execute(sql)
    results = cursor.fetchall()
    if results:
        for row in results:
            temp = str(float(row[1])+float(value))
            sql = "UPDATE alipay_by_buyer SET total=%s WHERE pay_by_buyer = '%s'" % (temp,key)
            print 'Start>>>\n'+sql
            cursor.execute(sql)
            db.commit()
        print results
    else:
        sql = """INSERT INTO alipay_by_buyer (pay_by_buyer,total) 
              VALUES ('%s',%s)""" % (key,value)
        
        #print 'Start>>>\n'+sql
        cursor.execute(sql)
        db.commit()

       
db.close()

