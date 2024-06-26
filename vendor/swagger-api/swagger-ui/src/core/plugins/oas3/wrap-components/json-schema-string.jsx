import React from "react"
import { OAS3ComponentWrapFactory } from "../helpers"

export default OAS3ComponentWrapFactory(({ Ori, ...props }) => {
  const {
    schema,
    getComponent,
    errors,
    onChange
  } = props

  const format = schema && schema.get ? schema.get("format") : null
  const type = schema && schema.get ? schema.get("type") : null
  const Input = getComponent("Input")

  if(type && type === "string" && (format && (format === "binary" || format === "base64"))) {
    return <Input type="file"
                   className={ errors.length ? "invalid" : ""}
                   title={ errors.length ? errors : ""}
                   onChange={(e) => {
                     onChange(e.target.files[0])
                   }}
                   disabled={Ori.isDisabled}/>
  } else {
    return <Ori {...props} />
  }
})
