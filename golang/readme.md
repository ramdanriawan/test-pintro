for fast run, u can click app.exe (windows os), or u can open terminal with this folder root and type ./app.cmd

0. Make sure mysql is installed & running, create a database called penggajian_pintro, and import the penggajian_pintro.sql database file in this folder (if u not import & setting, the database is using on my vps database /  my online database).
1. Make sure golang is installed, if it hasn't been installed according to your OS, for windows download & install at the link: https://go.dev/dl/go1.20.3.windows-amd64.msi
2. database settings are in the src/config/connection.go folder
3. open terminal and run command -> go mod download && go mod verify
4. open a terminal and run the command go run main.go
5. Documentation API link: https://documenter.getpostman.com/view/6597551/2s93eVXE2R
6. to get by user_token (absensi token) / admin_token u can see in documentation link api
7. design system is: Repository design pattern