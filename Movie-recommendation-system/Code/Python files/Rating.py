__author__ = 'suhas'

import csv
import re
from senti_classifier import senti_classifier
array = []
allratings = []
allRatings = []
with open('/home/suhas/Downloads/userTable.csv','r+') as f:
        with open('/home/suhas/Downloads/user.csv','wb') as f1:
            reader = csv.reader(f)
            writer = csv.writer(f1)
            for row in reader:
        #re.sub(r'[^\w]','',row[4])
                array.append(re.sub(r'!""',' ',row[4]))
            for i in array:
                pos_score,neg_score = senti_classifier.polarity_scores([i])
                sum = pos_score+neg_score
                if(sum==0):
                    pos_percentage = 0
                    rating = 0
                else:
                    pos_percentage = (pos_score)/(pos_score+neg_score)*100
                    if(pos_percentage >= 85):
                        rating = 5
                    elif(pos_percentage >= 70 and pos_percentage < 85):
                        rating = 4
                    elif(pos_percentage >= 55 and pos_percentage < 70):
                        rating = 3
                    elif(pos_percentage >= 40 and pos_percentage < 55):
                        rating = 2
                    elif(pos_percentage >= 25 and pos_percentage < 40):
                        rating = 1
                    else:
                        rating = 0
                print i, rating
                allratings.append(rating)
                allRatings.append(row[4])
                allRatings.append(allratings)
                print allRatings

with open("user.csv") as infile, open("outfile.csv", "w") as outfile:
    for line in infile:
        outfile.write(line.replace(",", ""))


