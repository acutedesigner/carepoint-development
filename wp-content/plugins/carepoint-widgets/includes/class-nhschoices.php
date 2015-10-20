<?php

/**
 *
 * NHS Choices RSS Feed
 * 
 */

// Story: A user will navigate the NHS Choices Live Well feed

// Scenario: Clicks the link in the admin menu for the NHS Choices Feed: Browse Feed

// 	Link "Browse Feed" clicked
// 		Loads up the plugin landing page
// 		includes the HTML template view (Styles using css)
// 		includes the NHS Choices JS file
// 		Get Live Well landing page as json "http://v1.syndication.nhschoices.nhs.uk/livewell/topics.json/?apikey=ENHSUADG"
// 		JSON then injected into the HTML
// 			each url is replaced to contain .json

// Scenario: Clicks topic "bullying" the Live Well page

// 	@javascript
// 	Request gets the json for topic "bullying"
// 		Get topic "bullying" landing page as json "http://v1.syndication.nhschoices.nhs.uk/livewell/topics/bullying.json?apikey=ENHSUADG"
// 		Title is extracted from the url
// 		Title & Url is added to breadcrumbs object 
// 		HTML content div is emptied
// 		JSON then injected into the HTML content div
// 			each url is replaced to contain .json

// 	@javascript
// 	User selects an article
// 		Get article page as json
// 			fails check for json
// 			Get content as text/html
// 			HTML content div is emptied
// 		JSON then injected into the HTML content div
// 		Article url is saved as string for action url
// 		Title is extracted from the url
// 		Title & Url is added to breadcrumbs object 

// Scenario: User want to navigate up a level

// 	@javascript
// 	breadcrumbs should be built up from before


// Story: Save found article as post within wordpress

// Scenario: User Clicks "Save article"

// 	Retrieve $_GET['article_url']
// 	Build the XML url
// 	Load Form with fields:
// 		Categories
// 		$_GET['article_url']

// 	Get the xml url content
// 	parse the xml content
// 	save the xml content as a post
// 	if all is well show user a confirmation page

if(!class_exists('nhsChoicesFeed'))
{

class nhsChoicesFeed
{

}

}

