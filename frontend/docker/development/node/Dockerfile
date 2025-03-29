FROM node:22-alpine

RUN apk add --no-cache curl

ENV NODE_OPTIONS --no-deprecation

WORKDIR /app

USER node

HEALTHCHECK --interval=5s --timeout=5s --start-period=1s CMD curl --fail http://127.0.0.1:3000/health || exit 1
