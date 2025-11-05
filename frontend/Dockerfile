# This is a multistage build:
# note the "as build" that is used to reference the node container
# when creating the apache container with "--from=build"

FROM node:16.3-alpine  as build
WORKDIR /app
ENV PATH /app/node_modules/.bin:$PATH
COPY ./package.json ./
COPY ./package-lock.json ./
RUN npm ci
COPY . ./
RUN npm run build


FROM nginx:1.27.1-alpine


# Configure Nginx
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf



# Copy the react build
COPY --from=build /app/build/ /usr/share/nginx/html/docs/

RUN chgrp -R 0 /usr/share/nginx/html/docs && \
    chmod -R g=u /usr/share/nginx/html/docs