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
</br>
POST
```
userExist(token, email)

returns boolean
```
</br>
POST
```
userById(token, id)

returns user
```
</br>
POST
```
addUser(name, email, password)

returns boolean
```
</br>

## Respone codes
```
100 REQUEST METHOD NOT VALID
</br>
101 REQUEST CONTENTTYPE NOT VALID
</br>
102 REQUEST NOT VALID
</br>
103 VALIDATE PARAMETER REQUIRED
</br>
104 VALIDATE PARAMETER DATATYPE
</br>
105 API NAME REQUIRED
</br>
106 API PARAM REQUIRED
</br>
107 API DOES NOT EXIST
</br>
108 INVALID CLIENT PASSWORD
</br>
109 CLIENT NOT ACTIVE
</br>
110 SQL VIOLATION
</br>
200 SUCCESS RESPONSE
</br>
300 JWT PROCESSING ERROR
</br>
301 AUTHORIZATION HEADER NOT FOUND
</br>
302 ACCESS TOKEN ERROR
</br>
```