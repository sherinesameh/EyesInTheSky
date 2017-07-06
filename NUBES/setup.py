from distutils.core import setup

setup(
    name='NUBES',
    version='0.2',
    description="Face Recognition Application Running Over EITS Mobile Adhoc Cloud System.",
    author='Sherine Sameh , Yamen Emad , Mohamed Sherif ',
    author_email='EITS@hotmail.com',
    url='https://github.com/SherineSameh/EyesInTheSky.git ',
    classifiers=[
        'Development Status :: 2 - Beta',
        'Environment :: Console',
        'Environment :: Web Environment',
        'Intended Audience :: End Users/Desktop',
        'Intended Audience :: Developers',
        'Intended Audience :: System Administrators',
        'License :: OSI Approved :: EITS Team License',
        'Operating System :: Lunix',
        'Programming Language :: Python',
        'Topic :: Face Recognition :: Mobile Adhoc Cloud System',
        'Topic :: Criminal Detection :: Neural Networks',
        ],    
    packages=['NUBES','NUBES.openface','NUBES.python','NUBES.util'],
    package_data={'NUBES.openface': ['*.lua']},

)
