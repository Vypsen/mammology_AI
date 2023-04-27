FROM python:3.8
# установка рабочей директории в контейнере
RUN apt-get update && apt-get install -y \
    build-essential \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/mammology

COPY requirements.txt .
# установка зависимостей

RUN pip install Flask opencv-python pylibjpeg-libjpeg pydicom
RUN #pip install --no-cache-dir -r requirements.txt

COPY ./AI .

# копирование содержимого локальной директории src в рабочую директорию
EXPOSE 5000
# команда, выполняемая при запуске контейнера
CMD [ "python", "app.py" ]
