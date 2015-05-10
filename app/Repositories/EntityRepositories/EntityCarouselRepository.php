<?php
    namespace App\Repositories\EntityRepositories;

    use App\Models\Carousel;
    use App\Repositories\RepositoryInterfaces\ICarouselRepository;

    class EntityCarouselRepository implements ICarouselRepository 
    {
        /**
         * Returns a Carousel model depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return Carousel
         */ 
        public function get($id)
        {
            return Carousel::find($id);
        }

        /**
         * Returns all the Carousel models in the database.
         * 
         * @return Collection -> Carousel
         */
        public function getAll()
        {
            return Carousel::all();
        }
		
		public function getAllFiltered()
		{
			$allcarousel = Carousel::all();
			
			$curDate = date('Y-m-d H:i:s',time());
			
			$carousel = [];
			foreach ($allcarousel as $c) {
				if ($c->news->hidden == 0 && $c->news->publishStartDate <= $curDate && $c->news->publishEndDate >= $curDate) {
					$carousel[] = $c;
				}
			}
			
			return $carousel;
		}

        /**
         * Creates a Carousel record in the database.
         * 
         * @param  array() $attributes
         * 
         * @return Carousel
         */
        public function create($attributes)
        {
            return Carousel::Create($attributes);
        }

        /**
         * Updates a Carousel record in the database depending on 
         * the Carousel model provided.
         * 
         * @param  Carousel $model
         * 
         * @return void
         */
        public function update($model)
        {
            $model->save();
        }

        /**
         * Deletes a Carousel record depending on the id provided.
         * 
         * @param  int $id
         * 
         * @return void
         */
        public function destroy($id)
        {
            $model = Carousel::findOrFail($id);
            $model->delete();
        }

        /**
         * Deletes all the Carousel records.
         * 
         * @return void
         */ 
        public function deleteAll()
        {
            $table = $this->getAll();
			foreach ($table as $item) {
				$item->delete();
			}
        }
    }