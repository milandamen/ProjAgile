
function AddCourse() {
	var searchterm = document.getElementById('artikeltitel').value;

	$.getJSON('/Course/GetCourseNameAndEC/?id=' + searchterm)
		.done(function (dataresult) {
			if ($('#linkedCoursesTableRow' + dataresult.id).length > 0) {
				//Element already exists!
				console.log('AddCourse(): element already exists!');
				statusP.innerHTML = 'Course is already in the list!';
			} else {
				$('#linkedCoursesTable').append(
					'<tr id="linkedCoursesTableRow' + dataresult.id + '">' +
						'<td style="display: none;">' +
							'<input type="text" name="linkedcourse" value="' + dataresult.id + '"></input>' +
						'</td>' +
						'<td>' + dataresult.coursename + '</td>' +
						'<td>' + dataresult.ec + ' EC</td>' +
						'<td width="105">' +
							'<a href="#" class="btn btn-danger" onclick="RemoveCourse(' + dataresult.id + ')">Verwijder</a>' +
						'</td>' +
					'</tr>'
				)
			}
		})
		.fail(function (jqxhr, textStatus, error) {
			//Fails if no articles can be found with the given term or if the syntax is wrong.
			var err = textStatus + ', ' + error;
			console.log('Request failed: ' + err);
		});
}

function goBack() {
    window.history.back()
}
