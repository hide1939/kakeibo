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
- before making some files, setup some infrastructures on GCP
    - Look this!
        - https://cloud.google.com/kubernetes-engine/docs/quickstart?hl=ja
    - cluster
        - gcloud container clusters create cluster-name --num-nodes=1
            - 1 node cluster
    - cloudSQL
    - LoadBalancer

- make Dockerfile
package app to docker images

- build Docker image
docker build --file=deploy/Dockerfile -t kakeibo .

- authenticate the Docker CLI (command line interface) tool to the container registry
gcloud auth configure-docker

- get project id
    - gcloud config get-value project

- tag images
docker tag kakeibo gcr.io/myproject-301613/kakeibo:v1(tag name)
docker tag kakeibo gcr.io/myproject-301613/kakeibo:latest

- push Docker images to GCR
docker push gcr.io/myproject-301613/kakeibo:v1
docker push gcr.io/myproject-301613/kakeibo:latest

- create deployment.yml(kubernetes manifest file)
kubectl create deployment kakeibo --image=gcr.io/myproject-301613/kakeibo:v1 --dry-run -o yaml > deployment.yaml

- get credentials to contact(connect) GKE cluster
gcloud container clusters get-credentials [cluster-name]

- at the second time, update deployment.yml
    - update image tag

- apply deployment.yaml
cd deploy/k8s
kubectl apply -f deployment.yaml

- check deployment
    - kubectl get deployments

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
        - chmod -R 777 storage/
        - chmod -R 777 bootstrap/cache/


- delete cluster
gcloud container clusters delete [cluster name]


# memo
- HTTP(S)ロードバランサはプロキシサーバーで、このトピックの LoadBalancerタイプのServiceで説明するネットワークロードバランサとは根本的に異なります。(https://cloud.google.com/kubernetes-engine/docs/concepts/service?hl=ja)

- GKEの3つのロードバランサ(https://cloud.google.com/kubernetes-engine/docs/concepts/network-overview?hl=ja#ext-lb)

- GKEでホストされているHTTP(S)サービスを公開する場合は、負荷分散としてHTTP(S)負荷分散の利用をおすすめします(https://cloud.google.com/kubernetes-engine/docs/tutorials/http-balancer?hl=ja)

- Deployment オブジェクト
    - ウェブサーバーのようなステートレスアプリケーションをデプロイするためのオブジェクト
- Service オブジェクト
    - インターネットからアプリケーションにアクセスする際のルールと負荷分散を定義
    - アプリケーションをデプロイしたら、ユーザーがアクセスできるように、そのアプリケーションをインターネットに公開する必要があります
    - アプリケーションを公開するには、Service を作成します
    - Service は、アプリケーションと外部トラフィックに公開するKubernetesリソース

- 作成したGKEクラスタにアプリをデプロイするには、2つのKubernetesオブジェクトが必要です
    - アプリを定義するDeployment
        - Deploymentを使用して、ReplicaSetとそれに関連するPodの作成と更新を行います。
    - アプリへのアクセス方法を定義するService
        - Serviceは、一連のPodに単一のアクセスポイントを提供します