__author__ = 'suhas'


#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect(host="localhost", # your host, usually localhost
                     user="suhas", # your username
                      passwd="jsuhas89", # your password
                      db="smm") # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("SELECT * FROM test")

# print all the first cell of all the rows
for row in cur.fetchall() :
    print row[0:2]