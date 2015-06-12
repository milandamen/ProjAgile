/**
	Grab list of articles using the input field as search term, then display articles in 2nd table.
*/
function searchArticle() 
{
	var searchterm = document.getElementById('artikeltitel').value;
	var searchresultsbody = document.getElementById('searchresults');

	$.getJSON(getArticlesByTitleURL + '/' + searchterm).done(function(dataresult) 
	{		
		var resulthtml = '';
		[].forEach.call(dataresult, function (item) 
		{
			resulthtml +=
				'<tr>' +
					'<td>' + 
						item.newsId + 
					'</td>' +
					'<td>' + 
						item.title + 
					'</td>' +
					'<td>' +
						item.publishStartDate +
					'</td>' +
					'<td>' +
						item.publishEndDate +
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
	.fail(function(jqxhr, textStatus, error) 
	{
		//Fails if no articles can be found with the given term or if the syntax is wrong.
		var err = textStatus + ', ' + error;
		console.log('Request failed: ' + err);
		
		searchresultsbody.innerHTML = ''
	});
}

/**
 Move the page from the third table to the 1st table.
 */
function addPage(button)
{
	var row = button.parentNode.parentNode;
	var id = row.children[0].textContent;
	var title = row.children[1].textContent;
	var startDate = row.children[2].textContent;
	var endDate = row.children[3].textContent;

	var articlelist = document.getElementById('articlelist');

	var resulthtml = articlelist.innerHTML;
	resulthtml +=
		'<tr>' +
		'<td> 0 </td>' +
		'<td><input type="hidden" name="sort[0]" value="page" />' +
		'Pagina</td>' +
		'<td>' +
		'<input type="text" name="artikel[]" value="' + id + '" class="hiddenInput" />' +
		'<span>' + id + '</span>' +
		'</td>' +
		'<td>' +
		'<span>' + title + '</span>' +
		'</td>' +
		'<td>' +
		'<span>' + startDate + '</span>' +
		'</td>' +
		'<td>' +
		'<span>' + endDate + '</span>' +
		'</td>' +
		'<td>' +
		'<textarea name="beschrijving[]"></textarea>' +
		'</td>' +
		'<td>' +
		'<input type="file" name="file[0]" />' +
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
 Grab list of pages using the input field as search term, then display articles in third table.
 */
function searchPage()
{
	var searchterm = document.getElementById('pageTitle').value;
	var searchresultsbody = document.getElementById('page-searchresults');

	$.getJSON(getPagesByTitleURL + '/' + searchterm).done(function(dataresult)
	{
		var resulthtml = '';
		[].forEach.call(dataresult, function (item)
		{
			console.log(dataresult);
			resulthtml +=
				'<tr>' +
				'<td>' +
				item.page.pageId +
				'</td>' +
				'<td>' +
				item.introduction.title +
				'</td>' +
				'<td>' +
				item.page.publishDate +
				'</td>' +
				'<td>' +
				item.page.publishEndDate +
				'</td>' +
				'<td>' +
				'<a class="btn btn-success btn-xs" onclick="addPage(this)">' +
				'<i class="fa fa-plus"></i>' +
				'</a>' +
				'</td>' +
				'</tr>';
		});

		searchresultsbody.innerHTML = resulthtml;
	})
		.fail(function(jqxhr, textStatus, error)
		{
			//Fails if no articles can be found with the given term or if the syntax is wrong.
			var err = textStatus + ', ' + error;
			console.log('Request failed: ' + err);

			searchresultsbody.innerHTML = ''
		});
}

$('.add-carousel-button').click(function() {

	$('#articlelist').append(
	'<tr>' +
		'<td> 0 </td>' +
		'<input type="hidden" name="sort[0]" value="carousel" />' +
		'<td>Carousel item</td>' +
		'<td>' +
			'<input type="text" name="artikel[0]" value="' + null + '" class="hiddenInput" />' +
			'<span> - </span>' +
		'</td>' +
		'<td>' +
			'<input type="text" name="carouselTitle[]"/>' +
		'</td>' +
		'<td>' +
			'<input type="text" name="carouselStartDate[]"/>' +
		'</td>' +
		'<td>' +
			'<input type="text" name="carouselEndDate[]"/>' +
		'</td>' +
		'<td>' +
			'<textarea name="beschrijving[]"></textarea>' +
		'</td>' +
		'<td>' +
			'<input type="file" name="file[0]" />' +
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
	'</tr>');

	calculateIndexes();
});

/**
	Move the article from the 2nd table to the 1st table.
*/
function addArticle(button) 
{
	var row = button.parentNode.parentNode;
	var id = row.children[0].textContent;
	var title = row.children[1].textContent;
	var startDate = row.children[2].textContent;
	var endDate = row.children[3].textContent;
	
	var articlelist = document.getElementById('articlelist');
	
	var resulthtml = articlelist.innerHTML;
	resulthtml +=
		'<tr>' +
			'<td> 0 </td>' +
			'<input type="hidden" name="sort[0]" value="news" />' +
			'<td>Nieuws</td>' +
			'<td>' +
				'<input type="text" name="artikel[0]" value="' + id + '" class="hiddenInput" />' +
				'<span>' + id + '</span>' +
			'</td>' +
			'<td>' +
				'<span>' + title + '</span>' +
			'</td>' +
			'<td>' +
				'<span>' + startDate + '</span>' +
			'</td>' +
			'<td>' +
				'<span>' + endDate + '</span>' +
			'</td>' +
			'<td>' +
				'<textarea name="beschrijving[]"></textarea>' +
			'</td>' +
			'<td>' +
				'<input type="file" name="file[0]" />' +
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
function removeArticle(button) 
{
	var row = button.parentNode.parentNode;
	row.parentNode.removeChild(row);
	
	calculateIndexes();
}

/**
	Move the article one row down in the 1st table
*/
function moveArticleDown(button) 
{
	var articlelist = document.getElementById('articlelist');
	
	// Because we have a header row, the first real table row starts at index 1.
	
	var srcRow = button.parentNode.parentNode;
	var srcI = srcRow.rowIndex;
	var dstRow = articlelist.rows[srcI];		// For some reason .rows does not count the header row, so no need for +1.

	if (dstRow != null) 
	{
		// Swap
		articlelist.insertBefore(dstRow, srcRow);
		
		calculateIndexes();
	}
}

/**
	Move the article one row up in the 1st table
*/
function moveArticleUp(button) 
{
	var articlelist = document.getElementById('articlelist');
	
	// Because we have a header row, the first real table row starts at index 1.
	
	var srcRow = button.parentNode.parentNode;
	var srcI = srcRow.rowIndex;

	if (srcI > 1)
	{
		var dstRow = articlelist.rows[srcI - 2];		// For some reason .rows does not count the header row, so no need for +1.
		
		// Swap
		articlelist.insertBefore(srcRow, dstRow);
		
		calculateIndexes();
	}
}

/**
	Re-calculate the indexes of the rows and inputs
*/
function calculateIndexes() 
{
	var i = 0;
	var articlelist = document.getElementById('articlelist');
	
	[].forEach.call(articlelist.children, function (row) 
	{
		row.children[0].textContent = i;
		var inputs = row.getElementsByTagName('input');

		[].forEach.call(inputs, function (input) 
		{
			if (input.type == 'file') 
			{
				input.name = 'file[' + i + ']';
			}
			else if(input.name.indexOf('sort') !== -1)
			{
				input.name = 'sort[' + i + ']';
			}
			else if(input.name.indexOf('carouselTitle') !== -1)
			{
				input.name = 'carouselTitle[]';
			}
			else if(input.name.indexOf('carouselStartDate') !== -1)
			{
				input.name = 'carouselStartDate[]';
			}
			else if(input.name.indexOf('carouselEndDate') !== -1)
			{
				input.name = 'carouselEndDate[]';
			}
			else if (input.name.indexOf('artikel') !== -1) 
			{
				input.name = 'artikel[' + i + ']';
			}
			else
			{
				input.name = 'deletefile[' + i + ']';
			}
		});
		i++;
	});
}

calculateIndexes();

function goBack() 
{
	window.history.back()
}

$("#cancel").click(function()
{
	document.getElementById("upload").value = "";
});

function validateCarousel()
{
	var startdate = $('.carousel-start-date');
	var enddate = $('.carousel-end-date');

	if(startdate > enddate)
	{
		alert('test');
		event.preventDefault();
	}
}