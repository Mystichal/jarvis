# Jarvis

### Table of contents

*   [General info](#general-info)
*   [Technologies](#technologies)
*   [Setup](#setup)
*   [Docker](#docker)
*   [Respone codes](#respone-codes)

## General info

This is a auth REST api

### Technologies

Project is created with:

*	Apache
*	Nginx
*	Php

## Setup

### Docker

Setup .env with all nessesary vars.
Build the docker container

```
$ docker build -t jarvis .
```

Remove the container

```
$ docker image rm jarvis
```
### Docker compose

Generate containers locally using docker compose:

```
$ docker compose up --build
```

Remove containers:

```
$ docker-compose down
```

## API functions
POST
```
generateToken(name, password)

returns token
```

POST
```
userExist(token, email)

returns boolean
```

POST
```
userById(token, id)

returns user
```

POST
```
addUser(name, email, password)

returns boolean
```

## Respone codes
```
100 REQUEST METHOD NOT VALID
101 REQUEST CONTENTTYPE NOT VALID
102 REQUEST NOT VALID
103 VALIDATE PARAMETER REQUIRED
104 VALIDATE PARAMETER DATATYPE
105 API NAME REQUIRED
106 API PARAM REQUIRED
107 API DOES NOT EXIST
108 INVALID CLIENT PASSWORD
109 CLIENT NOT ACTIVE
110 SQL VIOLATION
200 SUCCESS RESPONSE
300 JWT PROCESSING ERROR
301 AUTHORIZATION HEADER NOT FOUND
302 ACCESS TOKEN ERROR
```
