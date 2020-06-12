import sys,os
from gtts import gTTS   
# mytext = sys.argv[1]
mytext = "hello"
os.system(' say {mytext} ')
language = 'en'
myobj = gTTS(text=mytext, lang=language, slow=False) 
myobj.save("welcome.wav")

