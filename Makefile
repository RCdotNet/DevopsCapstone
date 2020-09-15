lint:
	# Linting the docker files
	hadolint Apache/Dockerfile
	hadolint mysql/Dockerfile
	# Linting php code for syntax issues
	./lintphp.sh Apache/app/*.php Apache/app/functions/*.php Apache/app/languages/*.php Apache/app/config/*.php

deploy_docker:
	export appver=$(shell git log --pretty=format:'%h' -n 1) &&\
		./create_docker_network.sh &&\
			./run_apache.sh 8500 80 &&\
				./run_mysql.sh v1

kill_docker:
	docker stop mywebapp &&\
		docker stop sql &&\
			docker network rm mynetwork &&\
				docker rm mywebapp &&\
					docker rm sql 
first_build:
	export appver=initial &&\
		./build_apache.sh  &&\
			./build_mysql_with_data.sh &&\
				./upload_apache.sh &&\
					./upload_mysql.sh
			 
inject:
	export appver=$(shell git log --pretty=format:'%h' -n 1) &&\
		./inject.sh

build:
	export appver=$(shell git log --pretty=format:'%h' -n 1) &&\
		./build_apache.sh

deploy_kubernetes:
	kubectl create -f deploy.yml &&\
		kubectl create -f deploysql.yml &&\
			kubectl create -f webroute.yml &&\
				kubectl create -f sqlservice.yml

kill_deployment:
	export appver=$(shell git log --pretty=format:'%h' -n 1) &&\
		echo $(appver) &&\
			./kill_deployment.sh

rollout:
	# export target=$(shell kubectl get service apacheroute -o=jsonpath={.spec.selector.ver})
		export appver=$(shell git log --pretty=format:'%h' -n 1) &&\
			./rollout.sh

upload_apache:
	export appver=$(shell git log --pretty=format:'%h' -n 1) &&\
		./upload_apache.sh

upload_mysql:
	export appver=$(shell git log --pretty=format:'%h' -n 1) &&\
		./upload_mysql.sh
