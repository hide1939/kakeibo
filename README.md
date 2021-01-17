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

- tag images
docker tag kakeibo gcr.io/{GCP_PROJECT_ID}/kakeibo:v1(tag name)
docker tag kakeibo gcr.io/{GCP_PROJECT_ID}/kakeibo:latest

- push Docker images to GCR
docker push gcr.io/{GCP_PROJECT_ID}/kakeibo:v1
docker push gcr.io/{GCP_PROJECT_ID}/kakeibo:latest

- create deployment.yml(kubernetes manifest file)
kubectl create deployment kakeibo --image=gcr.io/[project-id]/kakeibo:v1 --dry-run -o yaml > deployment.yaml

- apply deployment.yaml
kubectl apply -f deployment.yaml

- create service.yml
kubectl expose deployment kakeibo --port 80 --target-port=80 --type NodePort --dry-run -o yaml > service.yaml

- apply service.yaml
kubectl apply -f service.yaml