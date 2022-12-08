#!/usr/bin/env python
# -*- coding: utf-8 -*-

import hashlib, time, os
import sys, re, json

class CMSscanner:
    def __init__(self):
        self.fingerlist = []
        self.framework = []
        self.cmslist = []
    
    def load_fingerprint(self, file):
        # 载入cms指纹
        with open(file, 'rb')as f:
            self.fingerlist = json.load(f, encoding='utf-8')
        cms = []
        for finger in self.fingerlist:
            cms.append(finger["cmsname"])
        self.cmslist = list(set(cms))
        
    def load_framework(self, file):
        # 载入框架
        with open(file, 'r')as f:
            f = f.readlines()
            for line in f:
                line = line.replace('\n', '')
                self.framework.append(line)

    def traversal_file(self, path):
        # 遍历文件目录 (输入根目录)
        for item in os.scandir(path):
            if item.is_dir():
                self.check_dir(item)
                self.traversal_file(item)    
            elif item.is_file():
                self.check_file(item)
    
    def check_dir(self, entry):
        # 检查目录名称
        for it in self.framework:
            if it in entry.name:
                print('[+] Possible framework found:\t\t\t {} at {}'.format(it, entry.path))
    
    def get_relative_path(self, absolute_path):
        tmp = absolute_path.replace('\\', '/')
        r_path = tmp.replace('html', '')
        return r_path
        

    def check_file(self, entry):
        # 检查文件
        with open(entry.path, 'rb')as f:
            file = f.read()
        r_path = self.get_relative_path(entry.path)

        for finger in self.fingerlist:
            try:
                if finger["staticurl"]: # 静态文件
                    md5 = hashlib.md5()
                    md5.update(file)    # md5比对
                    md5_value = md5.hexdigest()
                    if finger["checksum"] == md5_value:
                        print("[+] Possible fingerprint found (md5):\t\t {} at {}".format(finger["cmsname"], entry.path))

                if finger["homeurl"]:
                    if finger["homeurl"] == r_path:
                        isMatch = re.search(finger["keyword"], file.decode(encoding='utf-8'), re.IGNORECASE)    # 关键词比对
                        if isMatch != None:
                            print("[+] Possible fingerprint found (keyword):\t {} at {}".format(finger["cmsname"], entry.path))
            except Exception as e:
                pass
        
        for cms in self.cmslist:
            try:
                if cms in file.decode(encoding='utf-8'):
                    print('[+] Possible fingerprint found (name):\t\t {} at {}'.format(cms, entry.path))
            except Exception as e:
                pass



if __name__ == '__main__':
    os.chdir('E:/learning/cybersecurity/AWD/CMS/fingerprint')
    scanner = CMSscanner()
    scanner.load_fingerprint('cmsprint.json')
    # scanner.load_fingerprint('finger.json')
    scanner.load_framework('framework.txt')
    scanner.traversal_file('html')
