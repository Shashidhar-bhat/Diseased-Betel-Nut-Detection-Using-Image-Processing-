import numpy as np
import cv2
from keras.models import load_model
from keras.preprocessing.image import ImageDataGenerator, img_to_array, load_img, array_to_img
import random,os,glob
from keras.preprocessing import image



import mysql.connector
mydb = mysql.connector.connect(host="localhost", user="root", password="", database="arecanut")
mycursor = mydb.cursor()


mycursor.execute("SELECT uploadimg FROM tbl_uploadimg ORDER BY id DESC LIMIT 1")
myresult = mycursor.fetchall()
testing = str(myresult)


testing = testing.replace('[(', '')
testing = testing.replace(',)]', '')
testing = testing.replace("'", "")




dir_path = 'C:/xampp/htdocs/arecanut/data'

img_list = glob.glob(os.path.join(dir_path, '*/*.jpg'))


train=ImageDataGenerator(horizontal_flip=True,
                         vertical_flip=True,
                         validation_split=0.1,
                         rescale=1./255,
                         shear_range = 0.1,
                         zoom_range = 0.1,
                         width_shift_range = 0.1,
                         height_shift_range = 0.1,)

test=ImageDataGenerator(rescale=1/255,
                        validation_split=0.1)

train_generator=train.flow_from_directory(dir_path,
                                          target_size=(300,300),
                                          batch_size=32,
                                          class_mode='categorical',
                                          subset='training')

test_generator=test.flow_from_directory(dir_path,
                                        target_size=(300,300),
                                        batch_size=32,
                                        class_mode='categorical',
                                        subset='validation')

labels = (train_generator.class_indices)
labels = dict((v,k) for k,v in labels.items())

model = load_model('trained_model.h5')

#img_path = 'C:/xampp/htdocs/arecanut/images/22.jpg'
img_path = 'C:/xampp/htdocs/arecanut/images/'+ testing
print(img_path)

img = image.load_img(img_path, target_size=(300, 300))
img = image.img_to_array(img, dtype=np.uint8)
img=np.array(img)/255.0


p=model.predict(img[np.newaxis, ...],verbose=None)

#print("Maximum Probability: ",np.max(p[0], axis=-1))
predicted_class = labels[np.argmax(p[0], axis=-1)]
if p[0] [-1] >= 0.5:
    print("unknown")
else:
    predicted_class = labels[np.argmax(p[0], axis=-1)]
    #print("Classified:",predicted_class)
    #print("Classified:",predicted_class)





id="1"
sql2 = "UPDATE tbl_result SET predicted = %s WHERE id = %s"
val = (str(predicted_class),id)

mycursor.execute(sql2, val)
mydb.commit()

