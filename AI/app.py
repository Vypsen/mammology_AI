from flask import Flask, request, jsonify
import numpy as np
from flask_cors import CORS
from torchvision import transforms, models
from PIL import Image
import torch
import os.path
import json
import io


app = Flask(__name__)
CORS(app)

@app.route('/image/upload', methods = ['POST'])
def hello():
    root_img = request.files['file'].read()
    root_par_model = 'res18_fisrt.pth'

    model = models.resnet18(pretrained=True)
    model.load_state_dict(torch.load(root_par_model))

    device = torch.device("cuda:0" if torch.cuda.is_available() else "cpu")
    model = model.to(device)

    loss = torch.nn.CrossEntropyLoss()
    optimizer = torch.optim.Adam(model.parameters(), lr=1e-3 )

    scheduler = torch.optim.lr_scheduler.StepLR(optimizer, step_size=5, gamma=0.5)

    transform = transforms.Compose([
        transforms.CenterCrop(2300),
        transforms.Resize((224,224)),
        transforms.ToTensor(),
        transforms.Normalize(
            mean=[0.485, 0.456, 0.406],
            std=[0.229, 0.224, 0.225]
        )
    ])

    image_tensor = transform(Image.open(io.BytesIO(root_img)).convert('RGB')).unsqueeze(0)

    device = torch.device("cuda" if torch.cuda.is_available() else "cpu")
    image_tensor = image_tensor.to(device)
    model = model.to(device)

    model.eval()

    with torch.no_grad():
        output = model(image_tensor)

    probabilities = torch.nn.functional.softmax(output[0], dim=0)
    predicted_class = torch.argmax(probabilities).item()

    return json.dumps(predicted_class)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
