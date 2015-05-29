<?php
	namespace App\Repositories\EntityRepositories;

	use App\Models\Permission;
	use App\Repositories\RepositoryInterfaces\IPermissionRepository;

	class EntityPermissionRepository implements IPermissionRepository
	{
		/**
		 * Returns a Permission model depending on the id provided.
		 *
		 * @param  int $permissionId
		 *
		 * @return Permission
		 */
		public function get($permissionId)
		{
			return Permission::find($permissionId);
		}

		/**
		 * Returns all the Permission models in the database.
		 *
		 * @return Collection -> Permission
		 */
		public function getAll()
		{
			return Permission::all();
		}

		/**
		 * Creates a Permission record in the database.
		 *
		 * @param  array() $attributes
		 *
		 * @return Permission
		 */
		public function create($attributes)
		{
			return Permission::Create($attributes);
		}

		/**
		 * Updates a Permission record in the database depending on
		 * the Permission model provided.
		 *
		 * @param  Permission $model
		 *
		 * @return void
		 */

		public function update($model)
		{
			$model->save();
		}

		/**
		 * Deletes a Permission record depending on the id provided.
		 *
		 * @param  int $permissionId
		 *
		 * @return void
		 */
		public function destroy($permissionId)
		{
			$model = Permission::findOrFail($permissionId);
			$model->delete();
		}
	}