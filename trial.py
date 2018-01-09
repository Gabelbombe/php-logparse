import os

def read_file(filename):
    filepath = os.path.join(r'input', filename)

    try:
        with open(filepath, 'rU') as f:
            return [x.strip('\n') for x in f.readlines()]
    except Exception as ex:
        print(ex)

def parse_stages()

def main():
    new_data = read_file('pipeline.log')
    for i in new_data:
        print(i)        # etc... more code will follow

if __name__ == '__main__':
    main()
