#!D:\Programs\Windows\Python\Python310\python.exe

import json
import concurrent.futures
import mysql.connector


def readdb1():
    db1 = mysql.connector.connect(
        host="localhost",
        user="root",
        password="mysql10",
        database="bdda1"
    )

    csr1 = db1.cursor()

    # requette -> lignes de type séparés
    # csr1.execute("SELECT enseignants.ID_Enseignant,enseignants.Nom , enseignants.Prenom , cours.Nom  AS Cours ,cours.ID_Cours ,type_enseignement.Type From enseignants join enseignements on enseignements.ID_Enseignant=enseignants.ID_Enseignant inner join cours on enseignements.ID_Cours=cours.ID_Cours inner JOIN type_enseignement on enseignements.ID_Enseignant=type_enseignement.ID_Enseignant")

    csr1.execute("select enseignants.ID_Enseignant, enseignants.Nom, enseignants.Prenom, cours.Nom as Cours, cours.ID_Cours, group_concat(`Type` separator ', ') as `Type` from enseignements join cours on cours.ID_Cours = enseignements.ID_Cours inner join enseignants on enseignants.ID_Enseignant = enseignements.ID_Enseignant inner join type_enseignement on type_enseignement.ID_Enseignement = enseignements.ID_Enseignement group by ID_Enseignant, enseignements.ID_Enseignement")
    res1 = csr1.fetchall()
    cols1 = csr1.description
    dic1 = []

    for x in res1:
        sub = {}
        for i in range(len(x)):
            sub[cols1[i][0]] = x[i]
        dic1.append(sub)

    return dic1


def readdb2():
    db2 = mysql.connector.connect(
        host="localhost",
        user="root",
        password="mysql10",
        database="bdda2"
    )

    csr2 = db2.cursor()
    # csr2.execute("SELECT enseignants.ID_Enseignant,enseignants.Nom , enseignants.Prenom , cours.Nom  AS Cours ,cours.ID_Cours ,type_enseignement.Type From enseignants join enseignements on enseignements.ID_Enseignant=enseignants.ID_Enseignant inner join cours on enseignements.ID_Cours=cours.ID_Cours inner JOIN type_enseignement on enseignements.ID_Enseignant=type_enseignement.ID_Enseignant")
    csr2.execute("select enseignants.ID_Enseignant, enseignants.Nom, enseignants.Prenom, cours.Nom as Cours, cours.ID_Cours, group_concat(`Type` separator ', ') as `Type` from enseignements join cours on cours.ID_Cours = enseignements.ID_Cours inner join enseignants on enseignants.ID_Enseignant = enseignements.ID_Enseignant inner join type_enseignement on type_enseignement.ID_Enseignement = enseignements.ID_Enseignement group by ID_Enseignant, enseignements.ID_Enseignement")
    res2 = csr2.fetchall()
    cols2 = csr2.description
    dic2 = []

    for x in res2:
        sub = {}
        for i in range(len(x)):
            sub[cols2[i][0]] = x[i]
        dic2.append(sub)

    return dic2


with concurrent.futures.ThreadPoolExecutor() as excutor:
    t1 = excutor.submit(readdb1)
    t2 = excutor.submit(readdb2)
    print(json.dumps(t1.result()+t2.result()))
