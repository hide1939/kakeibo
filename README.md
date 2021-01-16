# kakeibo
- This is my original kakeibo app.

# Laravel8.x memo
- routing
had to write like this
Route::get('/regist', [RegistController::class, 'create']);

- factory
had to write like this
User::factory()->create();

# technical memo
- I used following command to create deployment.yml 
kubectl create deployment kakeibo --image=gcr.io/[project-id]/kakeibo:v1 --dry-run -o yaml > deployment.yaml
