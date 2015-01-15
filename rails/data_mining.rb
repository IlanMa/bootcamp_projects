require 'open-uri' #includes the open-uri library
require 'nokogiri' #inclides the nokogiri library
puts "http://espn.go.com" #ask user for a site, remember there needs to be an http:// before the address!
page = Nokogiri::HTML(open("http://espn.go.com/")) #gets the page source
content = page.css('p').collect{ |node| node.text }.join(" ")
#grabs all the <p> tags and puts them into one string
array = content.split(' ')

def count(string)
  occurance = Hash.new(0)
  string.each { |string| occurance[string.downcase] += 1 }
  occurance = occurance.sort_by {|word, occurrence| occurrence }
  occurance.reverse
end
print "the top 10 words are"
print count(array)[0..10]



