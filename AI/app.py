from flask import Flask, request, jsonify
import numpy as np
from flask_cors import CORS
# from torchvision import transforms, models
# import torch
from PIL import Image
import os.path
import json
import base64
import io
import pandas as pd
import tensorflow as tf
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import load_img
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from skimage import transform
import tensorflow.keras.utils as image
from tensorflow.keras.preprocessing.image import img_to_array
from sklearn.cluster import KMeans
import requests
app = Flask(__name__)
CORS(app)


@app.route('/', methods=['GET'])
def index():
    return 'hello'

@app.route('/image/cluster', methods=['POST'])
def cluster():

    root_img = request.files['file'].read()

    image_list = []
    rgb_img = np.array(Image.open(io.BytesIO(root_img)).convert('RGB'))

    df_rgb_img = pd.DataFrame([rgb_img[:, :, 0].flatten(),
                               rgb_img[:, :, 1].flatten(),
                               rgb_img[:, :, 2].flatten()]).T
    df_rgb_img.columns = ['Red_Channel', 'Green_Channel', 'Blue_Channel']

    kmeans = KMeans(n_clusters=3, random_state=42).fit(df_rgb_img)
    result = kmeans.labels_.reshape(rgb_img.shape[0], rgb_img.shape[1])

    for n, ax in enumerate(range(3)):
        imge = Image.open(io.BytesIO(root_img)).convert('RGB')
        img_array = np.array(imge)
        img_array[:, :, 0] = img_array[:, :, 0] * (result == [n])
        img_array[:, :, 1] = img_array[:, :, 1] * (result == [n])
        img_array[:, :, 2] = img_array[:, :, 2] * (result == [n])
        img = Image.fromarray(img_array)

        img_buffer = io.BytesIO()
        img.save(img_buffer, format='PNG')
        img_str = base64.b64encode(img_buffer.getvalue()).decode('utf-8')

        image_list.append(img_str)

    return {'images': image_list}

@app.route('/image/prediction', methods=['POST'])
def getPrediction():

    root_img = request.files['file'].read()
    root_par_model = 'model.h5'
    model = load_model(root_par_model)

    val_datagen = ImageDataGenerator(rescale=1. / 255.)
    img = Image.open(io.BytesIO(root_img)).convert('RGB')
    X = np.array([img_to_array(img)])
    pred_proba = model.predict(val_datagen.flow(X))[0][0]
    pred = 1
    if pred_proba >= 0.5:
        pred = 0

    return jsonify(pred)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, threaded=True)
