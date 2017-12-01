#!/usr/bin/ruby

require "negapoji"
require "cgi"


def error_cgi
	print "*** CGI Error List ***<br />"
	print "#{CGI.escapeHTML($!.inspect)}<br />"
	$@.each {|x| print CGI.escapeHTML(x), "<br />"}
end

begin

	print "Content-Type:text/html;charset=utf8\n\n"

	cgi = CGI.new

	# print("contetn-type: text/html\n\n")
	print("HELLO")

	text =  CGI.escapeHTML(cgi['sentence'])
	print text
	# text = "あいうえお"
	print Negapoji.judge(text) if text.is_a?(String)
rescue
	error_cgi
end
