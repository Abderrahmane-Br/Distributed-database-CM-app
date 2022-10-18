#!D:\Programs\Windows\Python\Python310\python.exe

import json
import concurrent.futures
import string
from unittest import result
import mysql.connector

db1 = mysql.connector.connect(
    host="localhost",
    user="root",
    password="mysql10",
    database="bdda1"
)

db2 = mysql.connector.connect(
    host="localhost",
    user="root",
    password="mysql10",
    database="bdda2"
)
csr1 = db1.cursor()
csr1.execute("SELECT * FROM enseignants")

csr2 = db2.cursor()
csr2.execute("SELECT * FROM etudiants")

res1 = csr1.fetchall()
res2 = csr2.fetchall()

cols1 = csr1.description
cols2 = csr2.description

dic1, dic2 = [], []

for x in res1:
    sub = {}
    for i in range(len(x)):
        sub[cols1[i][0]] = x[i]
    dic1.append(sub)

for x in res2:
    sub = {}
    for i in range(len(x)):
        sub[cols2[i][0]] = x[i]
    dic2.append(sub)

print(json.dumps(dic2))
