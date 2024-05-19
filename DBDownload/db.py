import os
import glob
import zipfile
import subprocess

def get_latest_file(folder_path):
    file_list = glob.glob(os.path.join(folder_path, '*'))
    
    if not file_list:
        return None
    
    sorted_files = sorted(file_list, key=os.path.getmtime, reverse=True)
    
    latest_file = sorted_files[0]
    
    return latest_file

def extract_largest_file(zip_file, output_folder):
    with zipfile.ZipFile(zip_file, 'r') as zip_ref:
        zip_ref.extractall(output_folder)
    
    extracted_files = os.listdir(output_folder)
    if not extracted_files:
        return None
    
    return output_folder

folder_path = 'F:\我的雲端硬碟\clockbackup'
output_folder = "D:\wamp64\www\clock\DBDownload\dbbackup"

if not os.path.exists(output_folder):
    os.makedirs(output_folder)

latest_zip_file = get_latest_file(folder_path)

if latest_zip_file:
    print("最新的檔案：", latest_zip_file)

    # 解壓縮.zip檔案並儲存到指定資料夾
    extraction_path = extract_largest_file(latest_zip_file, output_folder)
    
    if extraction_path:
        print("已解壓縮檔案到：", extraction_path)
        # 在解壓縮後的檔案中找到最新的檔案
        latest_extracted_file = get_latest_file(extraction_path)
        
        if latest_extracted_file:
            print("解壓縮後的最新檔案：", latest_extracted_file)

        ps1_file_path = 'D:\wamp64\www\clock\DBDownload\db.ps1'
        if os.path.isfile(ps1_file_path):
            subprocess.call(["powershell", "-File", ps1_file_path, latest_extracted_file])
            print("succes")
        else:
            print("not found .ps1")
    else:
        print("not found file")
else:
    print("not found .zip")