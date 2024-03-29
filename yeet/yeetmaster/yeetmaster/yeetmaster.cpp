#include "pch.h"
#include <iostream>
#include <thread>
#include "windows.h"
#include "stdio.h"
#include <string>
#include <urlmon.h>
#include <sstream>
#pragma comment(lib, "urlmon.lib")

std::string key;

static const std::string url = "http://localhost/WebToApp/api.php";

std::string getURLContent(std::string url)
{
	IStream* stream;
	HRESULT result = URLOpenBlockingStream(0, url.c_str(), &stream, 0, 0);
	if (result != 0)
	{
		//TODO: exit shit ka
	}
	char buffer[65536];
	unsigned long bytesRead;
	std::stringstream ss;
	stream->Read(buffer, 65536, &bytesRead);
	while (bytesRead > 0U)
	{
		ss.write(buffer, (long long)bytesRead);
		stream->Read(buffer, 65536, &bytesRead);
	}
	stream->Release();
	return ss.str();
}

void clearConsole()
{
	system("cls");
}

void outputInfo(std::string input)
{
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 15);
	std::cout << "[INFO] " << input << std::endl;
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 15);
}

void outputError(std::string input)
{
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 12);
	std::cout << "[ERROR] " << input << std::endl;
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 15);
}

void outputDebug(std::string input)
{
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 10);
	std::cout << "[DEBUG] " << input << std::endl;
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 15);
}

void outputHelp(std::string input)
{
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 11);
	std::cout << "[HELP] " << input << std::endl;
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE), 15);
}

class user {
	public:
		std::string key;
		bool loggedin = false;
};

user wowok;
void handle_command()
{



	clearConsole();
	outputHelp("Auth to enter key / Help to get commands");
	while (true)
	{
		std::string cmd;
		std::getline(std::cin, cmd);

		if (cmd == "help")
		{
			clearConsole();
			outputHelp("auth");
			outputHelp("please use the following commands for more information.");
			outputHelp("info");
			outputHelp("authors");
			continue;
		}
		if (cmd == "info")
		{
			outputHelp("This is a program");
			continue;
		}
		if (cmd == "author")
		{
			outputHelp("Monkeycow");
			continue;
		}

		if (cmd == "auth")
		{
			if (wowok.loggedin)
			{
				outputError("Already logged in :p");
				continue;
			}
			else
			{ 
			
			outputInfo("Key");
			std::getline(std::cin, key);

			std::string reply = getURLContent(url + "?type=0&key=" + key);
			}
		}
		clearConsole();
		outputError("unknown command.");
	}
}

int main()
{
	std::thread thread_command(handle_command);
	thread_command.join();
}