<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\NewsComment;
    use App\Repositories\RepositoryInterfaces\INewsCommentRepository;

    class EntityNewsCommentRepository implements INewsCommentRepository 
    {
        /**
         * Returns a NewsComment model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return NewsComment
         */ 
        public function get($id)
        {
            return NewsComment::find($id);
        }

        /**
         * Returns all the NewsComment models in the database.
         * 
         * @return Collection -> NewsComment
         */
        public function getAll()
        {
            return NewsComment::all();
        }

        /**
         * Creates a NewsComment record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return NewsComment
         */
        public function create($attributes)
        {
            return NewsComment::Create($attributes);
        }

        /**
         * Updates a NewsComment record in the database depending on 
         * the NewsComment model provided.
         * 
         * @param  NewsComment $model
         * 
         * @return void
         */
        
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a NewsComment record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = NewsComment::findOrFail($id);
            $model->delete();
        }
    }