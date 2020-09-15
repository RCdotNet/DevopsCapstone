#!/usr/bin/env bash
kubectl delete service apacheroute
kubectl delete service sql 
kubectl delete deployment mysqlserver
kubectl delete deployment capstone-$appver