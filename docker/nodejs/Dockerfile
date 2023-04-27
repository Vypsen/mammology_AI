FROM node:16

# Install dependencies
RUN apt-get update && apt-get install -y \
    vim \
    zip \
    unzip \
    curl

# Change current user
USER node

EXPOSE 5173


# https://github.com/vitejs/vite/discussions/3396
CMD ["sh", "-c", "npm config set legacy-peer-deps true && npm install --legacy-peer-deps && npm run dev -- --host "]
