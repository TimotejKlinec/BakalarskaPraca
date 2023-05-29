import sqlite3
import sys
import numpy as np
import pandas as pd
import firebase_admin
import os
from sklearn.metrics.pairwise import cosine_similarity
from firebase_admin import credentials
from firebase_admin import db
from array import *
import json


default_app = firebase_admin.initialize_app()
con = sqlite3.connect("C:\\sqlite\\hraci_databaza.db")


df = pd.read_sql_query('SELECT name, position, playerId, I_F_hits, I_F_highDangerxGoals, I_F_mediumDangerxGoals, '
                       'I_F_lowDangerxGoals, shotsBlockedByPlayer, I_F_xGoalsFromActualReboundsOfShots, '
                       'I_F_xGoals_with_earned_rebounds_scoreFlurryAdjusted, I_F_xGoals, I_F_takeaways, faceoffsWon, '
                       'I_F_penalityMinutes, I_F_primaryAssists, height , weight FROM hraci WHERE situation LIKE '
                       '"all" AND '
                       'stick IS NOT NULL', con)

user_input = pd.read_sql_query('SELECT name, position, I_F_hits, I_F_highDangerxGoals, I_F_mediumDangerxGoals, '
                               'I_F_lowDangerxGoals, shotsBlockedByPlayer, I_F_xGoalsFromActualReboundsOfShots, '
                               'I_F_xGoals_with_earned_rebounds_scoreFlurryAdjusted, I_F_xGoals, I_F_takeaways, '
                               'faceoffsWon, '
                               'I_F_penalityMinutes, I_F_primaryAssists, height , weight FROM user', con)

player_gear = pd.read_sql_query(
    'SELECT name, stick, gloves, helmet, skates, pants  FROM hraci WHERE situation LIKE "all" AND stick IS NOT NULL',
    con)

app = firebase_admin.get_app(name='[DEFAULT]')
os.environ["GOOGLE_APPLICATION_CREDENTIALS"] = 'bp-klinec-firebase-adminsdk-oc4cm-46199ba722.json'
ref = db.reference(app=app, url='https://bp-klinec-default-rtdb.europe-west1.firebasedatabase.app/players')
key=sys.argv[1]
data1=[]
data2=[]
data3=[]
data4=[]
data5=[]
data6=[]
data7=[]
data8=[]
data9=[]
data10=[]
data11=[]
data12=[]
data13=[]
data14=[]
data15=[]
data16=[]

user_name=ref.child('players').child(key).child('displayName').get() 
data1.append(user_name)
user_position=ref.child('players').child(key).child('position').get()
data2.append(user_position)
user_hit_ratio=ref.child('players').child(key).child('hit_ratio').get()
data3.append(float(user_hit_ratio))
user_shooting_close=ref.child('players').child(key).child('shooting_close').get()
data4.append(float(user_shooting_close))
user_shooting_medium=ref.child('players').child(key).child('shooting_medium').get()
data5.append(float(user_shooting_medium))
user_shooting_long=ref.child('players').child(key).child('shooting_long').get()
data6.append(float(user_shooting_long))
user_shot_blocking=ref.child('players').child(key).child('shot_blocking').get()
data7.append(float(user_shot_blocking))
user_rebound_goal=ref.child('players').child(key).child('rebound_goal').get()
data8.append(float(user_rebound_goal))
user_rebound_goal_multiple=ref.child('players').child(key).child('rebound_goal_multiple').get()
data9.append(float(user_rebound_goal_multiple))
user_scoring_ability=ref.child('players').child(key).child('scoring_ability').get()
data10.append(float(user_scoring_ability))
user_takeaway_ability=ref.child('players').child(key).child('takeaway_ability').get()
data11.append(float(user_takeaway_ability))
user_faceoffs=ref.child('players').child(key).child('faceoffs').get()
data12.append(float(user_faceoffs))
user_penalty_minutes=ref.child('players').child(key).child('penalty_minutes').get()
data13.append(float(user_penalty_minutes))
user_passing_ability=ref.child('players').child(key).child('passing_ability').get()
data14.append(float(user_passing_ability))
user_height=ref.child('players').child(key).child('height').get()
data15.append(int(user_height))
user_weight=ref.child('players').child(key).child('weight').get()
data16.append(int(user_weight))


data={'name':data1, 'position':data2, 'I_F_hits':data3, 'I_F_highDangerxGoals':data4, 'I_F_mediumDangerxGoals':data5, 'I_F_lowDangerxGoals':data6, 'shotsBlockedByPlayer':data7, 'I_F_xGoalsFromActualReboundsOfShots':data8, 'I_F_xGoals_with_earned_rebounds_scoreFlurryAdjusted':data9, 'I_F_xGoals':data10, 'I_F_takeaways':data11, 'faceoffsWon':data12, 'I_F_penalityMinutes':data13, 'I_F_primaryAssists':data14, 'height':data15, 'weight':data16}
user_df = pd.DataFrame(data)


position_table = df[df['position'].isin(user_df['position'].tolist())]

vector = (position_table.loc[:, ~position_table.columns.isin(['name', 'position', 'playerId', 'height', 'weight'])])
vector_user = (user_df.loc[:, ~user_df.columns.isin(['name', 'position', 'height', 'weight'])])
result = cosine_similarity(vector, vector_user)
index_result = (list(vector.index.values))
dicts = {}



for i in range(len(result)):
    dicts[index_result[i]] = result[i][0]

sorted_dicts = sorted(dicts.items(), key=lambda x: x[1], reverse=True)
converted_dict = dict(sorted_dicts)
players = []
values = []
for i in converted_dict:
    players.append(i)
for j in converted_dict.values():
    values.append(j)

def myround(x, base):
    return base * round(x / base)


arr= [["" for j in range(8)] for i in range(3)]

result_players=[]

for i in range(len(players)):
    range_height = range(user_df.iloc[0]["height"] - 3, user_df.iloc[0]["height"] + 3, 1)
    if df.iloc[players[i]]["height"] in range_height and (myround(values[i]*100, 1) > 50):
        result_players.append(i)


if len(result_players) < 3:
    result_players.clear()
    for i in range(len(players)):
        result_players.append(i)
    

for i in range(3):
    arr[i][0]=df.iloc[players[result_players[i]]]["name"]
    arr[i][1]=player_gear.iloc[players[result_players[i]]]["stick"]
    arr[i][2]=str(myround((((user_df.iloc[0]["weight"] * 2.2046) / 2) - 5), 5))
    arr[i][3]=player_gear.iloc[players[result_players[i]]]["gloves"]
    arr[i][4]=player_gear.iloc[players[result_players[i]]]["helmet"]
    arr[i][5]=player_gear.iloc[players[result_players[i]]]["skates"]
    arr[i][6]=player_gear.iloc[players[result_players[i]]]["pants"]
    arr[i][7]=myround(values[result_players[i]]*100, 1)

print (json.dumps(arr))
con.close()