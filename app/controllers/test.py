import subprocess

# Command with shell expansion
#subprocess.call('ls', shell=True)

#p = subprocess.Popen("ls", stdout=subprocess.PIPE)
#result = p.communicate()[0]
#print result



#p = subprocess.Popen(["ls"], stdout=subprocess.PIPE)
#out, err = p.communicate()

#print out

#print err

import sys

#path = str(sys.argv[1])
path = "/opt/lampp/htdocs/EyesInTheSky/
test_uploads"
#saveFile = open('textFile.txt','w');
#saveFile.write(path);
#saveFile.close();
def subprocess_cmd(command):
    process = subprocess.Popen(command,stdout=subprocess.PIPE, shell=True);
    #proc_stdout = process.communicate()[0].strip();
    #print proc_stdout;
    out, err = process.communicate()
    #print proc_stdout
    print out
    print err
    #$words = proc_stdout.split('Successfully built');
    #$id = $words[1].strip();
    #words = proc_stdout.split('Successfully built');
    #id = words[1].strip();
    #print words
    #print id 
    #print id;
    saveFile = open('textFile.txt','w');
    saveFile.write(out);
    saveFile.close();


command  = "cd "+path+" ; docker build .";
#subprocess_cmd('echo a; echo b')

subprocess_cmd(command);

