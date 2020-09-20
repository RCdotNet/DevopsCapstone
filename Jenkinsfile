pipeline {
  environment {
    target = "rcdotnet/cameleon"
    targetCredential = 'Docker'
    dockerImage = ''
  }
  agent any

  stages {
    stage ('Inject version and aplication'){
      steps{
        sh 'make inject'
      }
  }

    stage('Linting') {
      steps {
        sh 'make lint'
      }
    }

  stage('Build app') {    
     steps { 
      script { 
        appver = sh(returnStdout: true, script: "git log --pretty=format:'%h' -n 1").trim() 
        echo "$appver"
        dir ('Apache'){  
          target = docker.build target + ":$appver" 
        }
      }
    }
  }

  stage('push container to Dockerhub app') {
    steps {
      script{
          echo "$appver"
          script {
            docker.withRegistry( '', targetCredential ) {
              target.push()
            }
          }
        }
      }
    }
    stage ('Create config file to let Jenkins access kubectl'){
      steps {
        withAWS (region: 'us-west-2', credentials:'AWSCred'){
         sh 'aws sts get-caller-identity'
         sh 'aws eks --region us-west-2 update-kubeconfig --name capstone-cluster'
        }
      }
    }
    stage ('Deploying to kubernetes'){
      steps {
        sh 'make rollout'
      }
    }
  }
}