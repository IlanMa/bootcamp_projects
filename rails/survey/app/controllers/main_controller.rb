class MainController < ApplicationController
  def index
  end

  def result
  if session[:counter] > 0
  		session[:counter] += session[:counter] + 1
  else
  	session[:counter] = 0;
  end
  	@values = params
  	render "main/result"
  end
end
