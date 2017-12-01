# coding: utf-8
require "negapoji"

while text = STDIN.gets
  p Negapoji.judge(text) if text.is_a?(String)
end

