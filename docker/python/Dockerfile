FROM python:3.8
# установка рабочей директории в контейнере
RUN apt-get update && apt-get install -y \
    build-essential \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN /usr/local/bin/python -m pip install --upgrade pip

RUN pip install Flask opencv-python pylibjpeg-libjpeg pydicom flask-cors tensorflow scikit-image scikit-learn pandas gunicorn
RUN #pip install --no-cache-dir -r requirements.txt


EXPOSE 5000
