package actions

import "github.com/gobuffalo/buffalo"

func MapHandler(c buffalo.Context) error {
	return c.Render(200, r.HTML("map.html"))
}
