<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\Comment;
    use App\Repositories\RepositoryInterfaces\ICommentRepository;

    class EntityCommentRepository implements ICommentRepository 
    {
        /**
         * Returns a Comment model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Comment
         */ 
        public function get($id)
        {
            return Comment::find($id);
        }

        /**
         * Returns all the Comment models in the database.
         * 
         * @return Collection -> Comment
         */
        public function getAll()
        {
            return Comment::all();
        }

        /**
         * Creates a Comment record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Comment
         */
        public function create($attributes)
        {
            return Comment::Create($attributes);
        }

        /**
         * Updates a Comment record in the database depending on 
         * the Comment model provided.
         * 
         * @param  Comment $model
         * 
         * @return void
         */
        
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Comment record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Comment::findOrFail($id);
            $model->delete();
        }
    }