class TimeController < ApplicationController
  def index
  	@time = Time.now.strftime("%b %d, %Y");
  	@time2 = Time.now.strftime("%I:%M %p");
  end
end
