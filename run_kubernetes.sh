#!/usr/bin/env bash

# This tags and uploads an image to Docker Hub

# Step 1:
# This is your Docker ID/path
 dockerpath="rcdotnet/cameleon:v1"

# Step 2
# Run the Docker Hub container with kubernetes
kubectl run cameleon\
    --generator=run-pod/v1\
    --image=$dockerpath\
    --port=80 --labels app=cap\
    --env=MYSQL_ROOT_PASSWORD=Uda\
    --image-pull-policy=Always

# Start the apache server
kubectl exec cameleon service apache2 start



# Step 3:
# List kubernetes pods
kubectl get pods

# Step 4:
# Forward the container port to a host
kubectl port-forward cameleon 8099:80

