#!D:\Programs\Windows\Python\Python310\python.exe
import sys

query = ""
for i in range(1, len(sys.argv)):
    query = query +' '+ str(sys.argv[i])
# query = query + "zzzzzzzzzzabc"
print(query)