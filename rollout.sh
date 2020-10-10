#!/usr/bin/env bash
export node=$(kubectl get node)
export target=$(kubectl get service apacheroute -o=jsonpath={.spec.selector.ver})
whoami
echo $node
echo $target
echo $appver
sed  "s/initial/${appver}/" deploy.yml > rollout.yml
sed  "s/initial/${appver}/" webroute.yml > switchower.yml
whoami
kubectl config current-context
kubectl config get-contexts
kubectl apply -f rollout.yml
#kubectl get deployment capstone-$target -o=yaml | sed -e "s/$target/$appver/g" | kubectl apply -f - 
kubectl rollout status deployment/capstone-$appver
kubectl apply -f switchower.yml
#kubectl get service apacheroute -o=yaml | sed -e "s/$target/$appver/g" | kubectl apply -f -  
#kubectl delete deployment capstone-$target
#What?