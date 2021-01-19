# about this app
- This is my original kakeibo app. I made this to make my skills and knowledges up.


# Laravel8.x memo
- routing
how to write routing
Route::get('/regist', [RegistController::class, 'create']);

- factory
how to write routing
User::factory()->create();


# technical memo

## How to deploy this app to GKE
- make Dockerfile
package app to docker images

- build Docker image
docker build --file=deploy/Dockerfile -t kakeibo .

- authenticate the Docker CLI (command line interface) tool to the container registry
gcloud auth configure-docker

- tag images
docker tag kakeibo gcr.io/myproject-301613/kakeibo:v1(tag name)
docker tag kakeibo gcr.io/myproject-301613/kakeibo:latest

- push Docker images to GCR
docker push gcr.io/myproject-301613/kakeibo:v1
docker push gcr.io/myproject-301613/kakeibo:latest

- create deployment.yml(kubernetes manifest file)
kubectl create deployment kakeibo --image=gcr.io/myproject-301613/kakeibo:v1 --dry-run -o yaml > deployment.yaml

- apply deployment.yaml
cd deploy/k8s
kubectl apply -f deployment.yaml

- create service.yml
kubectl expose deployment kakeibo --port 80 --target-port=80 --type NodePort --dry-run -o yaml > service.yaml

- apply service.yaml
cd deploy/k8s
kubectl apply -f service.yaml

- if backends is HEALTHY, it's ok

- check service specification
kubectl get service -o yaml

- get an "outside world" link to our application
kubectl get services
kubectl get services kakeibo

- setting permission
Laravelをインストールした後に、多少のパーミッションの設定が必要。storage下とbootstrap/cacheディレクトリをWebサーバから書き込み可能にする必要あり。
    - 二つのコンテナの両方に入ったところで以下のコマンドを実行
        - chmod 777 storage/
        - chmod 777 bootstrap/cache/


- delete cluster
gcloud container clusters delete [cluster name]


# memo
- HTTP(S)ロードバランサはプロキシサーバーで、このトピックの LoadBalancerタイプのServiceで説明するネットワークロードバランサとは根本的に異なります。(https://cloud.google.com/kubernetes-engine/docs/concepts/service?hl=ja)

- GKEの3つのロードバランサ(https://cloud.google.com/kubernetes-engine/docs/concepts/network-overview?hl=ja#ext-lb)

- GKEでホストされているHTTP(S)サービスを公開する場合は、負荷分散としてHTTP(S)負荷分散の利用をおすすめします(https://cloud.google.com/kubernetes-engine/docs/tutorials/http-balancer?hl=ja)