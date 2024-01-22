<?xml version="1.0"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/">
	<channel>
		<title>$Title</title>
		<link>$Link</link>
		<atom:link href="$Link" rel="self" type="application/rss+xml" />
		<description>$Description.XML</description>

		<% loop $Entries %>
		<item>
			<title>$Title.XML</title>
            <link><% if $RSSLink %>$RSSLink<% else %>$AbsoluteLink<% end_if %></link>
			<% if $RSSContent %><description>$RSSContent.XML</description>
            <% else_if $Description %><description>$Description.AbsoluteLinks.XML</description><% end_if %>
            <% if $RSSPublishDate %><pubDate>$RSSPublishDate.Rfc822</pubDate>
            <% else_if $PublishDate %><pubDate>$PublishDate.Rfc822</pubDate>
			<% else_if $Date %><pubDate>$Date.Rfc822</pubDate>
			<% else %><pubDate>$Created.Rfc822</pubDate><% end_if %>
			<% if $Author %><dc:creator>$Author.XML</dc:creator><% end_if %>
			<% if $Image %><media:content url="$Image.FocusFill(360,240).AbsoluteURL" type="$Image.MimeType" width="360" height="240" /><% end_if %>
			<guid>$AbsoluteLink</guid>
		</item>
		<% end_loop %>
	</channel>
</rss>
