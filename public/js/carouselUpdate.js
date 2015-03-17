
/**
	Grab list of articles using the input field as search term, then display articles in 2nd table.
*/
function searchArticle() {
	var searchterm = document.getElementById('artikeltitel').value;
	var searchresultsbody = document.getElementById('searchresults');

	$.getJSON('/ProjAgile/public/NewsController/getArticlesByTitle/' + searchterm)
		.done(function (dataresult) {
			console.log(dataresult);
			
			var resulthtml = '';
			[].forEach.call(dataresult, function (item) {
				resulthtml +=
					'<tr>' +
						'<td>' + 
							item.newsId + 
						'</td>' +
						'<td>' + 
							item.title + 
						'</td>' +
						'<td>' + 
							'<a class="btn btn-success btn-xs" onclick="addArticle(this)">' + 
								'<i class="fa fa-plus"></i>' + 
							'</a>' + 
						'</td>' +
					'</tr>';
			});
			
			searchresultsbody.innerHTML = resulthtml;
		})
		.fail(function (jqxhr, textStatus, error) {
			//Fails if no articles can be found with the given term or if the syntax is wrong.
			var err = textStatus + ', ' + error;
			console.log('Request failed: ' + err);
			
			searchresultsbody.innerHTML = ''
		});
}

/**
	Move the article from the 2nd table to the 1st table.
*/
function addArticle(button) {
	var row = button.parentNode.parentNode;
	var id = row.children[0].textContent;
	var title = row.children[1].textContent;
	
	var articlelist = document.getElementById('articlelist');
	
	var resulthtml = articlelist.innerHTML;
	resulthtml +=
		'<tr>' +
			'<td> 0 </td>' +
			'<td>' +
				'<input type="text" name="artikel[0]" value="' + id + '" class="hiddenInput" />' +
				'<span>' + id + '</span>' +
			'</td>' +
			'<td>' +
				title +
			'</td>' +
			'<td>' +
				'<a class="btn btn-primary btn-xs" onclick="moveArticleUp(this)">' +
					'<i class="fa fa-arrow-up"></i>' +
				'</a>' +
			'</td>' +
			'<td>' +
				'<a class="btn btn-primary btn-xs" onclick="moveArticleDown(this)">' +
					'<i class="fa fa-arrow-down"></i>' +
				'</a>' +
			'</td>' +
			'<td>' +
				'<a class="btn btn-danger btn-xs" onclick="removeArticle(this)">' +
					'<i class="fa fa-times"></i>' +
				'</a>' +
			'</td>' +
		'</tr>';
	
	articlelist.innerHTML = resulthtml;
	
	calculateIndexes();
}

/**
	Remove the article from the 1st table
*/
function removeArticle(button) {
	var row = button.parentNode.parentNode;
	row.parentNode.removeChild(row);
	
	calculateIndexes();
}

/**
	Move the article one row down in the 1st table
*/
function moveArticleDown(button) {
	var articlelist = document.getElementById('articlelist');
	
	// Because we have a header row, the first real table row starts at index 1.
	
	var srcRow = button.parentNode.parentNode;
	var srcI = srcRow.rowIndex;
	var dstRow = articlelist.rows[srcI];		// For some reason .rows does not count the header row, so no need for +1.
	if (dstRow != null) {
		// Swap
		var srcHtml = srcRow.innerHTML;
		srcRow.innerHTML = dstRow.innerHTML;
		dstRow.innerHTML = srcHtml;
		
		calculateIndexes();
	}
}

/**
	Move the article one row up in the 1st table
*/
function moveArticleUp(button) {
	var articlelist = document.getElementById('articlelist');
	
	// Because we have a header row, the first real table row starts at index 1.
	
	var srcRow = button.parentNode.parentNode;
	var srcI = srcRow.rowIndex;
	if (srcI > 1) {
		var dstRow = articlelist.rows[srcI - 2];		// For some reason .rows does not count the header row, so no need for +1.
		
		// Swap
		var srcHtml = srcRow.innerHTML;
		srcRow.innerHTML = dstRow.innerHTML;
		dstRow.innerHTML = srcHtml;
		
		calculateIndexes();
	}
}

/**
	Re-calculate the indexes of the rows and inputs
*/
function calculateIndexes() {
	var i = 0;
	var articlelist = document.getElementById('articlelist');
	
	[].forEach.call(articlelist.children, function (row) {
		row.children[0].textContent = i;
		row.getElementsByTagName('input')[0].name = 'artikel[' + i + ']';
		
		i++;
	});
}

function goBack() {
    window.history.back()
}