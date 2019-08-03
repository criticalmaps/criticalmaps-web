package actions

import "github.com/gobuffalo/buffalo"

func InfoHandler(c buffalo.Context) error {
	return c.Render(200, r.HTML("info.html"))
}
