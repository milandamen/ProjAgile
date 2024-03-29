<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\DistrictSection;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;

	class EntityDistrictSectionRepository implements IDistrictSectionRepository
	{
		/**
		 * Returns a DistrictSection model depending on the id provided.
		 *
		 * @param  int $id
		 *
		 * @return DistrictSection
		 */
		public function get($id)
		{
			return DistrictSection::find($id);
		}

		/**
		 * Returns all the DistrictSection models in the database.
		 *
		 * @return Collection -> DistrictSection
		 */
		public function getAll()
		{
			return DistrictSection::all();
		}
		
		/**
		 * Creates a DistrictSection record in the database.
		 *
		 * @param  array() $attributes
		 *
		 * @return DistrictSection
		 */
		public function create($attributes)
		{
			return DistrictSection::Create($attributes);
		}

		/**
		 * Updates a DistrictSection record in the database depending on
		 * the DistrictSection model provided.
		 *
		 * @param  DistrictSection $model
		 *
		 * @return void
		 */
		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a DistrictSection record depending on the id provided.
		 *
		 * @param  int $id
		 *
		 * @return void
		 */
		public function destroy($id)
		{
			$model = DistrictSection::findOrFail($id);
			$model->delete();
		}

		/**
		 * Returns a DistrictSection model depending on the name provided.
		 *
		 * @param  string $name
		 *
		 * @return DistrictSection
		 */
		public function getByName($name)
		{
			return DistrictSection::where('name', '=', $name)->first();
		}

		/**
		 * Returns all the DistrictSection model id's in the database.
		 *
		 * @return array()
		 */
		public function getAllIds()
		{
			$districtSections = DistrictSection::all();
			$districtSection_ids = [];

			foreach($districtSections as $districtSection)
			{
				$districtSection_ids[] = $districtSection->districtSectionId;
			}

			return $districtSection_ids;
		}
		
		/**
		 * Returns all the DistrictSection models from the database and
		 * converts it to a list. This is for select box use only.
		 *
		 * @return List -> DistrictSection
		 */
		public function getAllToList()
		{
			return DistrictSection::all()->lists('name', 'districtSectionId');
		}


		public function getAllLikeTerm($term)
		{
			return DistrictSection::where('name' ,'LIKE' , '%' . $term . '%')->get();
		}
	}