# Udacity DevOps Engineer Nanodegree Capstone project
## Project to demonstrate the learned skills
### Project overwiew
In this project I used a PHP project I developed earlier for a customer. The objective is to provide a simple booking system for the custumers motel. 
The goal is to extend the project running on bare metal to running on AWS cloud as containariezed application instead and provdide a high availability application, with CI/CD solution.
The project uses blue/green deployment model to provide zero down time and easy rollback capacitability in case something goes wrong.

### Overview

The project deploys 3 pods of the application with load balancer, and one pod with the undrlaying MySql database. Each webapp connects to the same database. In case of a new deployment (triggered by pushing the remote master repo) triggers a new pipeline  execution in Jenkins, and the new application delivered. When the new application healty, the load balancer switces over to the new application. ( on the lower left side off the screen you can see the actual repo SHA changing at each deployment along with the internal IP of the app proofing the load balancer functionality)

## Prerequisites
You need the following prerequisites:
* AWS account configured 
* Docker, Jenkins, AWS CLI installed
* Jenkins installed, credentials configured to access Docker hub and AWS
* Docker, AWS plugins installed
* IAM User configured to access EKS on behalf of you as jenkins user
* In the third line of jenkinsfile enironment section definine your dockerhub id as: target = "yourid/cameleon"

## Deploying the infrastructure
After cloning the repository, the first thing to do to run the init script by issuing ./init.sh That will initiate the deployment of kubernetes infrastructure, and as a final step deploy the application initial state.
Be patient, to create infrastructure takes time. Check the on screen announcements. When everything finished, you will see the endpoint of the app. Use port 8090 to connect. This will present the Apache default screen. If this is OK, go ahead and check out URL:8090/admin.php that leads you to the app.
From here, just make modifications, push to your repo and the app will be updtated.

## Other considerations
The project uses make utiliy to cordinate the most of the processes, but Jenkins uses its docker capabilities to build and push iamages. The make utility has some extra function to build and deploy to docker, or a local minikube instance.

### Furter improvements posibilities
This application is not designed to persist SQL data. The data is persistent as long the mysqlserver deployment part of the application lives in kubernetes. It can be extended to persist the data, and eventually even make the database part scalable.
