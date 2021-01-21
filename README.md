# About
- This is my original kakeibo(household expenses) app. I made this to make my skills and knowledges about programming, gcp and some other services up.


# Laravel8.x note
- routing
how to write routing
Route::get('/regist', [RegistController::class, 'create']);

- factory
how to write factory
User::factory()->create();


# Technical note

## How to deploy this app to GKE
- before making some manifest files, setup some infrastructures on GCP
    - basically, look this
        - https://cloud.google.com/kubernetes-engine/docs/quickstart?hl=ja
    - cluster
        - gcloud container clusters create cluster-name --num-nodes=1
            - 1 node cluster
    - cloudSQL
    - LoadBalancer

- make Dockerfile
package the app to docker image

- build Docker image
docker build --file=deploy/Dockerfile -t kakeibo .

- get credentials to contact(connect) to GKE cluster
    - to get this command have to go gcp > gke > cluster > operation > connection
gcloud container clusters get-credentials [cluster-name]

- authenticate the Docker CLI (command line interface) tool to the container registry
gcloud auth configure-docker

- get project id
gcloud config get-value project

- tag images
docker tag kakeibo gcr.io/[project id]/kakeibo:v1(tag name)
docker tag kakeibo gcr.io/[project id]/kakeibo:latest

- push Docker images to GCR
docker push gcr.io/[project id]/kakeibo:v1
docker push gcr.io/[project id]/kakeibo:latest

- create deployment.yaml(kubernetes manifest file)
kubectl create deployment kakeibo --image=gcr.io/[project id]/kakeibo:v1 --dry-run -o yaml > deployment.yaml

- at the second time and after, have to update deployment.yaml to update pods
    - have to update image tag version

- apply deployment.yaml(give instructions to master node to pull image to  the pods and make pods and container process)
cd deploy/k8s
kubectl apply -f deployment.yaml

- check deployment
    - kubectl get deployments

- create service.yml(NodePort Type)
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

- setting permission to Laravel
Laravelをインストールした後に、多少のパーミッションの設定が必要。storage下とbootstrap/cacheディレクトリをWebサーバから書き込み可能にする必要あり。
after installing laravel, you have to setup permissions to the laravel directory. have to make under "storage" and "bootstrap/cache" writable
    - use this command afterr enter pod and container
        - chmod -R 777 storage/
        - chmod -R 777 bootstrap/cache/

- delete cluster
gcloud container clusters delete [cluster name]


# Memo
- HTTP(S)ロードバランサはプロキシサーバーで、このトピックの LoadBalancerタイプのServiceで説明するネットワークロードバランサとは根本的に異なります。(https://cloud.google.com/kubernetes-engine/docs/concepts/service?hl=ja)

- GKEの3つのロードバランサ(https://cloud.google.com/kubernetes-engine/docs/concepts/network-overview?hl=ja#ext-lb)

- GKEでホストされているHTTP(S)サービスを公開する場合は、負荷分散としてHTTP(S)負荷分散の利用をおすすめします(https://cloud.google.com/kubernetes-engine/docs/tutorials/http-balancer?hl=ja)

- Deployment オブジェクト
    - ウェブサーバーのようなステートレスアプリケーションをデプロイするためのオブジェクト
- Service オブジェクト
    - インターネットからアプリケーションにアクセスする際のルールと負荷分散を定義
    - アプリケーションをデプロイしたら、ユーザーがアクセスできるように、そのアプリケーションをインターネットに公開する必要があります
    - アプリケーションを公開するには、Service を作成します
    - Serviceは、アプリケーションと外部トラフィックに公開するKubernetesリソース
    - podの集合にアクセスするための経路を定義

- 作成したGKEクラスタにアプリをデプロイするには、2つのKubernetesオブジェクトが必要です
    - アプリを定義するDeployment
        - Deploymentを使用して、ReplicaSetとそれに関連するPodの作成と更新を行います。
    - アプリへのアクセス方法を定義するService
        - Serviceは、一連のPodに「単一のアクセスポイント」を提供します

- ノードプールは、クラスタ内で同じ構成を持つノードのグループ
- プール内の各ノードにはKubernetesノードラベル cloud.google.com/gke-nodepoolが設定されます
- クラスタの作成時に指定したノード数とノードタイプがデフォルトのノードプールになります。 その後、クラスタに別のサイズやタイプのカスタムノードプールを追加できます。特定のノードプール内のノードはすべて同一になります

- Namespace 
    - クラスタ内の入れ子となる仮想的なクラスタ
        - クラスタが持つnamespace一覧
            - kubectl get namespace